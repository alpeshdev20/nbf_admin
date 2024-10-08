<?php

namespace App\Models;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class app_adv
 * @package App\Models
 * @version June 29, 2020, 7:37 am UTC
 *
 * @property string image
 * @property string material
 * @property boolean active
 */
class app_adv extends Model
{
    use SoftDeletes;

    public $table = 'app_ads';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        'image',
        'material',
        'active',
        'link',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'image' => 'string',
        'material' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'image' => 'required',
        'material' => 'required',
        'active' => 'required',
        'link' => 'required|url', 
    ];

    protected $dates = ['deleted_at']; 
    
}
