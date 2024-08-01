<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscriber_reading_list extends Model
{
    // get items in this list
	public function items(){
		return $this->hasMany('App\Models\reading_list_item', 'subscriber_reading_list_id', 'id');
	}
	
	 protected $fillable = [
		"name",
		"subscriber_id"
	 ];
	 
	 public static $rules = [
        'name' => 'required',
        'subscriber_id' => 'required'
    ];
}
