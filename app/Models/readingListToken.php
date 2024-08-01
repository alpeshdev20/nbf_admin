<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class readingListToken extends Model
{
    public $table = 'reading_list_token';

    public $fillable = [
        'teacher_id',
        'publisher_id',
        'reading_list_id',
        'token',
        'token_count',
        'used_token'
    ];
}
