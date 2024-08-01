<?php

namespace App\Repositories;

use App\Models\app_department;
use App\Repositories\BaseRepository;

/**
 * Class app_departmentRepository
 * @package App\Repositories
 * @version March 13, 2020, 11:33 am UTC
*/

class app_departmentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'department_name',
        'genre_id'
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
        return app_department::class;
    }
}
