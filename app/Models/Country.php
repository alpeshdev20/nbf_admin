<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $fillable = [
        'name',
        'iso3'
    ];

    /**
     * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'name' => 'text',
        'iso3' => 'string'
    ];
    
    public static $rules = [
    
    ];
}
