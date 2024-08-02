<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class genre
 * @package App\Models
 * @version January 23, 2020, 7:08 am UTC
 *
 * @property string genre_name
 */
class genre extends Model
{

    public $table = 'genres';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'genre_name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'genre_name' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'genre_name' => 'required'
    ];

    
}
