<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pa_token_batch_ids extends Model
{
    public $table = 'pa_token_batch_ids';

    public $fillable = [
        'batch_name',
        'reading_list_id'
    ];
}
