<?php

namespace App\DataTables;

use App\Models\Subscription_plan;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;

class Subscription_planDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'subscription_plans.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subscription_plan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscription_plan $model)
    {
        if(Auth::user()->access->access_role == 1) {
            return $model->newQuery();
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
            'name',
            'price',
            'validity',
            'description',
            'is_hide' => [
                'data' => 'is_hide',
                'name' => 'is_hide',
                'title' => 'Hidden',
                'render'=>'data == 1 ?  `YES` :  `NO` '
            ],
            'content_key',
            'plan_category'=>[
                'data' => 'plan_category', 
                'name' => 'plan_category', 'render'=>'data == 0 ? "Free" : data == 2 ? "Premium" : "Basic"'],
            'status'=>[
                'data' => 'status', 
                'name' => 'status', 
                'render'=>'data == 1 ? "Active" : "Inactive"'
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subscription_plansdatatable_' . time();
    }
}
