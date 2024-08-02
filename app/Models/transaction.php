<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public $table = 'transactions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->hasOne('App\Models\app_user', 'id', 'user_id');
    }

    public function user_address()
    {
        return $this->hasOne('App\Models\user_address','user_id', 'user_id');
    }

    public $fillable = [
        'subscription_name',
        'subscription_id',
        'amount',
        'subscription_validity',
        'status',
        'txn_id'
    ];

    protected $casts = [
            'id' => 'bigIncrements',
            'user_id' => 'integer',
            'amount' => 'integer',
            'subscription_id' => 'integer',
            'subscription_name' => 'string',
            'subscription_validity' => 'integer',
            'status' => 'string',
            'response_body' => 'text',
            'refund_amount' => 'integer',
            'refund_status' => 'string'
           

    ];
    public static $rules = [
    
    ];
}
