<?php

namespace App\DataTables;

use App\Models\book_publisher;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class book_publisherDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'book_publishers.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\book_publisher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(book_publisher $model)
    {
        return $model->newQuery()->with('admin');
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
            'owner' => ['data' => 'admin.name', 'name' => 'admin.name'],
            'publisher',
            'active' => ['data' => 'active', 'name' => 'active', 'render'=>'data == 1 ? "Active" : "Inactive"']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'book_publishersdatatable_' . time();
    }
}
