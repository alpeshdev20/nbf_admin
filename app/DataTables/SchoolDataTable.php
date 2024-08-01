<?php

namespace App\DataTables;

use App\Models\school;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;

class SchoolDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'schools.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\School $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(school $model)
    {
        if(Auth::user()->access->access_role == 1) {
			return $model->newQuery();
           // return $model->newQuery()->with(['schools','subscription']);
        }        
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
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
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
            'id',
            'name'=> ['data' => 'name', 'name' => 'school.name'],
            'parent_group'=> ['data' => 'parent_group', 'name' => 'school.parent_group'],
            'address'=>[
						'data' => ('address'), 
						'name' => ('address')
					],
            'pin'=> ['data' => 'pin', 'school' => 'pin'],
            /*'Authorized'=>['data' => 'authorized', 'name' => 'authorized', 'render'=>'authorized == 1 ? "Yes" :"No"']*/
			'Authorized'=>['data' => 'authorized', 'name' => 'authorized', 'render'=>'data==1?"Yes":"No"'],
			'Token'=>	[ 
						'exportable' => false, 'printable' => false,
						'searchable' => false, 'orderable' => false,
						'render'=>'function(data, type, row){return `<a href="${this.id}/managetokens" class="btn btn-xs btn-primary">Manage Tokens</a>`}']
						//'render'=>'(data)=>\'<a href="{{$row->id}}" class="btn btn-xs btn-primary">Manage Tokens</a>\'']
			

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'schoolsdatatable_' . time();
    }
}
