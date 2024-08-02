<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class admin_access
 * @package App\Models
 * @version July 3, 2020, 7:13 am UTC
 *
 * @property integer access_role
 * @property integer admin_id
 * @property boolean active
 */
class admin_access extends Model
{

    public $table = 'admin_accesses';
    
    public function role()
    {
        return $this->hasOne('App\Models\access_role', 'id', 'access_role');
    }

    public $fillable = [
        'access_role',
        'admin_id',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'access_role' => 'integer',
        'admin_id' => 'integer',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
