<?php

namespace App\DataTables;

use App\Models\app_adv;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class app_advDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'app_advs.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\app_adv $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(app_adv $model)
    {
        return $model->newQuery()
        ->leftjoin('material as app_material_type','app_material_type.id','=','app_ads.material')
        ->select('app_ads.*', 'app_material_type.material_type as material_type');
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
        $base= "https://ebook.netbookflix.com" . '/uploads/banner/';
        return [
            'image' => ['data' => 'image', 'name' => 'image', 'render'=>'"<a target=_blank href=' .$base . '" + encodeURIComponent(data) + ">" + data.substring(0,24) + "</a>"'],
            'material' => ['data' => 'material_type', 'name' => 'app_material_type.material_type'],
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
        return 'app_advsdatatable_' . time();
    }
}
