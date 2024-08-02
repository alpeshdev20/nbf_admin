<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class carousel
 * @package App\Models
 * @version January 24, 2020, 5:21 am UTC
 *
 * @property string banner_image
 */
class carousel extends Model
{

    public $table = 'carousels';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'banner_image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'banner_image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'banner_image' => 'required'
    ];

    
}
