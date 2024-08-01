<?php

namespace App\Repositories;

use App\Models\TeacherDetail;
use App\Repositories\BaseRepository;

/**
 * Class TeacherDetailRepository
 * @package App\Repositories
 * @version August 10, 2021, 2:42 pm UTC
*/

class TeacherDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'teacher_name',
        'mobile_no',
        'email',
        'institute_id',
        'department',
        'designation',
        'subject_taught',
        'resource_planning',
        'teaching_resource',
        'student_strength',
        'number_of_token'
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
        return TeacherDetail::class;
    }
}
