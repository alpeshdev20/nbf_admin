<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pa_token extends Model
{
    public $table = 'pa_token';

    public $fillable = [
        'token',
        'batch_id',
        'reading_list_id',
        'teacher_id'
    ];
}
