<?php

namespace App\DataTables;

use App\Models\Region;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RegionDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'regions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Continent $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Region $model)
    {
        return $model->newQuery()
        ->leftjoin("countries",\DB::raw("FIND_IN_SET(countries.id,regions.countries_id)"),">",\DB::raw("'0'"))
        ->select('regions.*', \DB::raw("GROUP_CONCAT(countries.name) as country_name"))
        ->groupBy('regions.id');
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
            'region_name',
            'country_name ' => ['data' => 'country_name', 'name' => 'countries.name'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename()
    // {
    //     return 'app_advsdatatable_' . time();
    // }
}