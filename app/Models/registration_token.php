<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class access_role
 * @package App\Models
 * @version July 3, 2020, 7:14 am UTC
 *
 * @property string role
 */
class registration_token extends Model
{

    public $table = 'registration_tokens';
    
	public $timestamps = false;


    public $fillable = [
        'token'=>'string','school_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'token'=>'string',
        'school_id'=>'integer',
        'active'=>'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
