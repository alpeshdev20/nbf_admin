<?php

namespace App\DataTables;

use App\Models\prescribed_reading_list;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\pa_token;
use DB;

class pa_token_usedDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
     
    public function dataTable($query)
    {
		/*
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'prescribed_reading_lists.action');
		*/	
		$dataTable = new EloquentDataTable($query);
        return $dataTable->addColumn('action', 'prescribed_reading_lists.datatables_actions');
			
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\prescribed_reading_list $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

     public function query(pa_token $model, Request $request)
     {
         $email = Auth::user()->email;
         $teacher = DB::table('teacherdetail')->where('email', $email)->first();
     
         $latestSubscribersSubquery = DB::table('subscribers')
             ->select('user_id', DB::raw('MAX(id) as latest_id'))
             ->groupBy('user_id');
     
         $query = $model->newQuery()
             ->leftJoin('u_logins', 'pa_token.used_by', '=', 'u_logins.id')
             ->leftJoin('prescribed_reading_lists', 'pa_token.reading_list_id', '=', 'prescribed_reading_lists.id')
             ->leftJoinSub($latestSubscribersSubquery, 'latest_subscribers', function ($join) {
                 $join->on('pa_token.used_by', '=', 'latest_subscribers.user_id');
             })
             ->leftJoin('subscribers', function ($join) {
                 $join->on('latest_subscribers.latest_id', '=', 'subscribers.id');
             })
             ->select('pa_token.*', 'subscribers.plan_name', 'u_logins.name as user_name', 'prescribed_reading_lists.name')
             ->where('pa_token.teacher_id', $teacher->id)
             ->whereNotNull('pa_token.used_by')
             ->orderBy('subscribers.id', 'desc');
           
         return $query;
     }
     
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
	
		return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'       => 'Blfrtip',
                "pageLength" => 10,
                "lengthChange" => true,
                'lengthMenu'=> [
                    [ 5,10, 25, 50, -1 ],
                    [ 5,10, 25, 50, 'Show all' ]
                ],
                'stateSave' => true,
                'order'     => [[0, 'desc']],                
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                    // ['extend' => 'pageLength','text'=>'Show 10 Rows <span class="dt-down-arrow">▼</span>', 'className' => 'btn btn-default btn-sm no-corner ',],
                    
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            'name' => ['data' => 'user_name', 'name' => 'u_logins.name'],
            'Reading list' => ['data' => 'name', 'name' => 'prescribed_reading_lists.name'],
            'token' => ['data' => 'token', 'name' => 'pa_token.token'],
            'subscription_plan' => ['data' => 'plan_name', 'name' => 'subscribers.plan_name'],
        ];
	
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'prescribed_reading_lists_' . date('YmdHis');
    }
}
