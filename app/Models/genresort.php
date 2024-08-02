<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class genresort
 * @package App\Models
 * @version January 24, 2020, 11:11 am UTC
 *
 * @property string genre_id
 * @property string sort
 */
class genresort extends Model
{

    public $table = 'genresorts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'genre_id',
        'sort'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'genre_id' => 'string',
        'sort' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'genre_id' => 'required',
        'sort' => 'required'
    ];

    
}
