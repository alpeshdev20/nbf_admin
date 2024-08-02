<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prescribed_reading_list extends Model
{
    // get items in this list
	public function items(){
		return $this->hasMany('App\Models\reading_list_item', 'prescribed_reading_list_id', 'id');
	}
	
	public function school(){
		return $this->hasOne('App\Models\School', 'id', 'prescriber_id');
	}
	
	
	 protected $fillable = [
		"name",
		"prescriber_id",
		"prescriber",
		"level",
		"teacher_id",
		"publisher_id"
	 ];
	 
	 public static $rules = [
        'name' => 'required',
        'prescriber_id' => 'required'
    ];
	
}
