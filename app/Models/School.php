<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class School
 * @package App\Models
 * @version October 7, 2022, 1:50 am UTC
 *
 * @property string $parent_group
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $pin
 * @property boolean $authorized
 */
class School extends Model
{

    public $table = 'schools';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'parent_group',
        'name',
        'address',
        'city',
        'state',
        'country',
        'pin',
        'authorized'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_group' => 'string',
        'name' => 'string',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'country' => 'string',
        'pin' => 'string',
        'authorized' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_group' => 'nullable|string|max:250',
        'name' => 'required|string|max:250',
        'address' => 'required|string',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'country' => 'required|string|max:100',
        'pin' => 'required|string|max:30',
        'authorized' => 'required|boolean'
    ];
    
}
