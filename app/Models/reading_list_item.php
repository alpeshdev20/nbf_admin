<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reading_list_item extends Model
{
    protected $fillable = [
		"subscriber_reading_list_id",
		"prescribed_reading_list_id",
		"app_material_id"
	 ];
	 
	 
	 public function materialName(){
		$this->hasOne('App\Models\app_material', 'id', 'app_material_id');
	 }
	 
	 public function material(){
		return $this->hasOne('App\Models\app_material', 'id', 'app_material_id');
	 }
	 
	 
}
