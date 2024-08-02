<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class flaged_genre
 * @package App\Models
 * @version January 24, 2020, 11:08 am UTC
 *
 * @property string genre_id
 * @property string genre_name
 */
class flaged_genre extends Model
{

    public $table = 'flagedgenres';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'genre_id',
        'genre_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'genre_id' => 'string',
        'genre_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'genre_id' => 'required',
        'genre_name' => 'required'
    ];

    
}
