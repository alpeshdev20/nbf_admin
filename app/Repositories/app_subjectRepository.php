<?php

namespace App\Repositories;

use App\Models\app_subject;
use App\Repositories\BaseRepository;

/**
 * Class app_subjectRepository
 * @package App\Repositories
 * @version March 13, 2020, 12:06 pm UTC
*/

class app_subjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'subject_name',
        'department_id'
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
        return app_subject::class;
    }
}
