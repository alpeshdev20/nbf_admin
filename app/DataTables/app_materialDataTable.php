<?php

namespace App\DataTables;

use App\Models\app_material;
use App\Models\book_publisher;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Illuminate\Support\Facades\Auth;

class app_materialDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'app_materials.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\app_material $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(app_material $model)
    {
        if(Auth::user()->access->access_role == 1) {
            return $model->newQuery()->whereNull('teacher_id')->with(['bookpublisher', 'bookdepartment', 'booksubject', 'bookgenre', 'booklangugae', 'booktype']);
        } else if(Auth::user()->access->access_role == 3) {
            $userId = auth()->id();
            return $model->newQuery()->where('teacher_id', $userId)->with(['bookpublisher', 'bookdepartment', 'booksubject', 'bookgenre', 'booklangugae', 'booktype']);
        } else {
            $publisher = array();
            $publishers = book_publisher::where('user_id', Auth::user()->id)->get();
            foreach($publishers as $pub) {
                $publisher[] = $pub->id;
	    }
            return $model->newQuery()->whereIn('publisher_id', $publisher)->with(['bookpublisher', 'bookdepartment', 'booksubject', 'bookgenre', 'booklangugae', 'booktype']);
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
        $base= "https://dumpin.in/ebook/public" . '/uploads/file/';
        if(Auth::user()->access->access_role == 3) {
            return [
                'id',
                'material' => ['data' => 'booktype.material_type', 'name' => 'booktype.material_type'],
                'title' => ['data' => 'book_name', 'name' => 'book_name'],
            ];
        }
        return [
            'id',
            'material' => ['data' => 'booktype.material_type', 'name' => 'booktype.material_type'],
	        'title' => ['data' => 'book_name', 'name' => 'book_name'],
            'genre' => ['data' => 'bookgenre.genre_name', 'name' => 'bookgenre.genre_name'],
            'department' => ['data' => 'bookdepartment.department_name', 'name' => 'bookdepartment.department_name'],
            'subject' => ['data' => 'booksubject.subject_name', 'name' => 'booksubject.subject_name'],
            'language' => ['data' => 'booklangugae.language_name', 'name' => 'booklangugae.language_name'],
            'publisher' => ['data' => 'bookpublisher.publisher', 'name' => 'bookpublisher.publisher'],
            'author' => ['data' => 'author', 'name' => 'author'],
            'year' => ['data' => 'year', 'name' => 'year'],
            'isbn_code' => ['data' => 'tags', 'name' => 'tags']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'app_materialsdatatable_' . time();
    }
}
