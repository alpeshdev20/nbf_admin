<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Subscriber
 * @package App\Models
 * @version August 8, 2020, 1:27 pm UTC
 *
 * @property string name
 * @property string email
 * @property string plan_name
 * @property integer plan_validity
 * @property string mobile
 */
class Subscriber extends Model
{

    public $table = 'subscribers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    protected $primaryKey = 'id';

    public $fillable = [
        // 'name',
        // 'email',
	'plan_name',
    	'plan_end_date',

        // 'mobile',
        'user_id',
	'subscription_id',
	'status'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\app_user', 'id', 'user_id');
    }

    public function subscription()
    {
        return $this->hasOne('App\Models\Subscription_plan', 'id', 'subscription_id');
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'email' => 'string',
        'plan_name' => 'string',
        'plan_end_date' => 'string',
        'subscription_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'subscription_id' => 'required',       
    ];

    
    
}
