<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class app_logos
 * @package App\Models
 * @version January 21, 2021, 8:32 am UTC
 *
 * 
 * @property string $file_path
 * @property string $text_1
 * @property string $text_2
 * @property string $text_3
 */
class app_logos extends Model
{

    public $table = 'logos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'file_path',
        'text_1',
        'text_2',
        'text_3'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        
        'text_1' => 'string',
        'text_2' => 'string',
        'text_3' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    
}
