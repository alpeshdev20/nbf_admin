<?php

namespace App\Repositories;

use App\Models\app_material;
use App\Repositories\BaseRepository;

/**
 * Class app_materialRepository
 * @package App\Repositories
 * @version March 13, 2020, 7:12 am UTC
*/

class app_materialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'book_name',
        'book_image',
        'publisher_id',
        'year',
        'book_pdf',
        'length',
        'summary',
        'tags',
        'author',
        'language',
        'material_type',
        'genre_id',
        'department_id',
        'subject_id',
        'age',
        'mat_category',
        'allow_country',
        'table_of_content',
        'author_detail',
        'slug',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return app_material::class;
    }
	
	public function getPublisherBooks($id){
		return $this->model::where('publisher_id', $id)->get(['id', 'year', 'book_name'])->toArray();
	}
	
    public function getTeacherBooks($id)
    {
        return $this->model::where('teacher_id', $id)->get(['id', 'year', 'book_name'])->toArray();
    }
}
