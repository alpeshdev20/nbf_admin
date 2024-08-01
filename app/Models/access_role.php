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
class access_role extends Model
{

    public $table = 'access_roles';
    



    public $fillable = [
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
