<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class app_publisher
 * @package App\Models
 * @version June 6, 2020, 10:43 am UTC
 *
 * @property string company_name
 * @property string address
 * @property string city
 * @property string postal_code
 * @property string upload_address_proof
 * @property string pan_card
 * @property string aadhar_card
 * @property string gst_or_tin_card
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string username
 * @property string password
 * @property string select_question
 * @property string security_answer
 * @property string check_box
 */
class app_publisher extends Model
{

    public $table = 'publisher_registrations';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'company_name',
        'address',
        'city',
        'postal_code',
        'upload_address_proof',
        'pan_card',
        'aadhar_card',
        'gst_or_tin_card',
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'select_question',
        'security_answer',
        'check_box'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'company_name' => 'string',
        'address' => 'string',
        'city' => 'string',
        'postal_code' => 'string',
        'upload_address_proof' => 'string',
        'pan_card' => 'string',
        'aadhar_card' => 'string',
        'gst_or_tin_card' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'username' => 'string',
        'password' => 'string',
        'select_question' => 'string',
        'security_answer' => 'string',
        'check_box' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'company_name' => 'required',
        'address' => 'required',
        'city' => 'required',
        'postal_code' => 'required',
        'upload_address_proof' => 'required',
        'pan_card' => 'required',
        'aadhar_card' => 'required',
        'gst_or_tin_card' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'username' => 'required',
        'password' => 'required',
        'select_question' => 'required',
        'security_answer' => 'required',
        'check_box' => 'required'
    ];

    
}
