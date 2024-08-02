<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedback extends Model
{
    public $fillable = [
        'book_id',
        'user_id',
        'feedback'
    ];

    /**
     * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [
        'book_id' => 'integer',
        'user_id' => 'integer',
        'feedback' => 'text'
    ];
    
    public static $rules = [
    
    ];
}
