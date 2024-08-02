<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class couponcodes extends Model
{
    public $table = 'coupon_codes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $primaryKey = 'id';

    public $fillable = [
        'code',
        'expiry_date',
        'discount_percentage',
        'status'
    ];

    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'expiry_date' => 'string',
        'discount_percentage' => 'integer',
        'status' => 'integer'

    ];
}
