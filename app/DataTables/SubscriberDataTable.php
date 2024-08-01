<?php

namespace App\DataTables;

use App\Models\Subscriber;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;

class SubscriberDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'subscribers.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Subscriber $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscriber $model)
    {
        if(Auth::user()->access->access_role == 1) {
            return $model->newQuery()->with(['user','subscription']);
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
            'name'=> ['data' => 'user.name', 'name' => 'user.name'],
            'email'=> ['data' => 'user.email', 'name' => 'user.email'],
            'plan_name',
            'plan_end_date',
            'user_type' => ['data' => 'user.registration_type', 'name' => 'user.registration_type', 'render' => 'data == 1 ? "School" : "Standard" '],
            'mobile'=> ['data' => 'user.mobile', 'name' => 'user.mobile'],
            'Plan status'=>['data' => 'status', 'name' => 'status', 'render'=>'data == 1 ? "Active" :data == 0? "Inactive":"Pending"'],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'subscribersdatatable_' . time();
    }
}
