<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ULogin extends Model
{

    protected $table = 'u_logins';
	
	public function schoolName(){
		return $this->hasOne('App\Models\school', 'id', 'school_id');
	}

    protected $fillable= [
        'name',
        'email' ,
        'password',
        'mobile', 
        'registration_type', 
        'registration_token', 
        'school_id', 
        'level', 
        'section'
  ];

    protected $hidden= [
            'password' 
    ];
}
