<?php

namespace App\DataTables;

use App\Models\prescribed_reading_list;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\readingListToken;

class prescribed_reading_listsDataTable extends DataTable
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
    public function query(prescribed_reading_list $model)
    {
        $query = $model->newQuery();
        if (Auth::user()->access->access_role == 3) {
            $query->where('teacher_id', Auth::user()->id);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
		/*
        return $this->builder()
                    ->setTableId('prescribed_reading_lists-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
		*/
		return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
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
		/*
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
		*/
		
		if(Auth::user()->access->access_role == 3) {
            return [
                Column::make('name')->title('List name'),
                Column::make('prescriber')->title('School'),
                Column::make('level')->width(60)->title('Class'),
                'Token'=>	[ 
                    'exportable' => false, 'printable' => false,
                    'searchable' => false, 'orderable' => false,
                    'render'=>'function(data, type, row){return `<a href="${this.id}/managetoken" class="btn btn-xs btn-primary">PA Tokens</a>`}']
            ];
        } else {
            return [
                Column::make('name')->title('List name'),
                Column::make('prescriber')->title('School'),
                Column::make('level')->width(60)->title('Class'),
            ];
          
        }
		
		
		
		
		
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
