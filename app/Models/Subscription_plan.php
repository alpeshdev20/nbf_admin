<?php

namespace App\Models;

use App\Models\genre;

use Eloquent as Model;

/**
 * Class Subscription_plan
 * @package App\Models
 * @version August 8, 2020, 1:07 pm UTC
 *
 * @property string name
 * @property integer price
 * @property string description
 * @property integer validity
 * @property integer status
 */
class Subscription_plan extends Model
{

    public $table = 'subscription_plans';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $primaryKey = 'id';

    public function genreName()
    {
        return $this->hasMany('App\Models\genre', 'id', 'id');
    }

    public $fillable = [
        'name',
        'price',
        'description',
        'validity',
        'status',
        'plan_category',
        'configuration_type',
        'allowed_material',
        'allowed_genres',
        'allowed_department',
        'allowed_subject',
        'allowed_publisher'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'price' => 'integer',
        'description' => 'string',
        'validity' => 'integer',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];

    public static function getConfigurationType()
    {
        return array(0 => 'Material Type', 1 => 'Customized (Genre, Department, Subject)');
    }
}
