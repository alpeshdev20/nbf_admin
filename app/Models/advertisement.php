<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class advertisement
 * @package App\Models
 * @version January 24, 2020, 5:27 am UTC
 *
 * @property string image
 * @property string heading
 * @property string description
 */
class advertisement extends Model
{

    public $table = 'advertisements';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'image',
        'heading',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'heading' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required',
        'heading' => 'required',
        'description' => 'required'
    ];

    
}
