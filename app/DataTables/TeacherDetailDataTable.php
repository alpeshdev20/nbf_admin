<?php

namespace App\DataTables;

use App\Models\TeacherDetail;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class TeacherDetailDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'teacher_details.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\TeacherDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TeacherDetail $model)
    {
        return $model->newQuery();
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
                'scrollX'   => true,
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
            'teacher_name',
            'mobile_no',
            'email',
            'institute_name',
            'department',
            'designation',
            'subject_taught',
            'resource_planning',
            'teaching_resource',
            'student_strength',
            'number_of_token' => [
                'data' => 'number_of_token',
                'name' => 'number_of_token',
                'title' => 'Token count'
            ],
            'is_pending' => [
                'data' => 'is_pending',
                'name' => 'is_pending',
                'title' => 'Status',
                'render'=>'data == 1 ?  `<p class="text-danger" title="To approve the request go to details page">Pending</p>` :  `<p class="text-success">Approved</p>`'
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
        return 'teacher_details_datatable_' . time();
    }
}
