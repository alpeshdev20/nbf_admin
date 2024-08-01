<?php

namespace App\DataTables;

use App\Models\app_subject;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class app_subjectDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'app_subjects.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\app_subject $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(app_subject $model)
    {
        return $model->newQuery()
                     ->leftjoin('app_department','app_department.id','=','app_subject.department_id')
                     ->select("app_subject.id","app_department.department_name as department_name", "app_subject.subject_name as subject_name");
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
            'department_name' => ['data' => 'department_name', 'name' => 'app_department.department_name'],
            'subject_name'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'app_subjectsdatatable_' . time();
    }
}
