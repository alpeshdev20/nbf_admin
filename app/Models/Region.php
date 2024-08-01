<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $fillable = [
        'region_name',
        'countries_id'
    ];

    /**
     * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string'
    ];
    
    public static $rules = [
        'region_name' => 'required',
        'countries_id' => 'required'

    ];

    public function contries_data()
    {
        return $this->belongsTo('App\Model\Country');
    }
}
