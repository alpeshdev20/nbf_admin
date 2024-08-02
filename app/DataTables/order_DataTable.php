<?php

namespace App\DataTables;

use App\Models\transaction;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class order_DataTable extends DataTable
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
        return $dataTable->addColumn('action', 'order.datatables_actions');
    }

    
    public function query(Transaction $model)
    {

        return $model->newQuery()
        ->where([
            ['status','=','TXN_SUCCESS'],
            ['amount','!=','0']
        ])
        ->leftjoin("u_logins",'transactions.user_id', '=' , 'u_logins.id')
        ->select('transactions.*','u_logins.name');
        
       
        
    }

   
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '20px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'ASC']],
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
            'user' => ['data' => 'name', 'name' => 'u_logins.name'],
            'amount'=> ['data' => 'amount', 'name' => 'transactions.amount'],
            'subscription_name' => ['data' => 'subscription_name', 'name' => 'transactions.subscription_name'],
            'subscription_validity' => ['data' => 'subscription_validity', 'name' => 'transactions.subscription_validity'],
            'status' => ['data' => 'status', 'name' => 'transactions.status']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactionsdatatable_' . time();
    }
}