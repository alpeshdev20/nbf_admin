<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class appmaterial_item extends Model
{
    public $table = 'app_material_item';

    protected $primaryKey = 'id';

    public $fillable = [
      'appmaterial_id',
      'title',
      'summary',
      'length',
      'image_file',
      'file',
      'release_date',
      'sequence'
    ];
}
