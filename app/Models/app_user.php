<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class app_user
 * @package App\Models
 * @version July 3, 2020, 6:52 am UTC
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string mobile
 */
class app_user extends Model
{

    public $table = 'u_logins';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'type',
        'user_type',  
        'password', 
        'birthday', 
        'gender', 
        'preferred_segment', 
        'class',  
        'is_active', 
        'personal_address', 
        'institute_address',
        'parent_user'
    ];

    public $hidden = [
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'mobile' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'mobile' => 'required'
    ];

    public function analytics()
    {
        return $this->hasMany('App\Models\app_book_analytic', 'user_id', 'id');
    }

    public function subscriber()
    {
        return $this->hasOne('App\Models\Subscriber', 'user_id', 'id');
    }
}
