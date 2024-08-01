<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class userfav
 * @package App\Models
 * @version January 24, 2020, 11:01 am UTC
 *
 * @property string user_id
 * @property string book_id
 */
class userfav extends Model
{

    public $table = 'userfavs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'user_id',
        'book_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'book_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'book_id' => 'required'
    ];

    
}
