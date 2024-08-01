<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class access_role
 * @package App\Models
 * @version July 3, 2020, 7:14 am UTC
 *
 * @property string role
 */
class token_batch_id extends Model
{

    public $table = 'token_batch_ids';
    
	public $timestamps = false;


    public $fillable = [
        'batch_name'=>'string','school_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'batch_name'=>'string',
        'school_id'=>'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
