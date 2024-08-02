<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class TeacherDetail
 * @package App\Models
 * @version August 10, 2021, 2:42 pm UTC
 *
 * @property string $teacher_name
 * @property string $mobile_no
 * @property string $email
 * @property string $inst_name
 * @property string $department
 * @property string $designation
 * @property string $sub_taught
 * @property string $resource_planing
 * @property string $teaching_resource
 * @property string $student_strength
 */
class TeacherDetail extends Model
{

    public $table = 'teacherdetail';
    



    protected $fillable = [
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
        'number_of_token',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'id' => 'integer',
    //     'teacher_name' => 'string',
    //     'mobile_no' => 'string',
    //     'email' => 'string',
    //     'institute_name' => 'string',
    //     'department' => 'string',
    //     'designation' => 'string',
    //     'subject_taught' => 'string',
    //     'resource_planning' => 'string',
    //     'teaching_resource' => 'string',
    //     'student_strength' => 'string'
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
