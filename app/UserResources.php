<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserResources extends Model
{
  
    protected $table = 'create_users_resources';

    // The attributes that are mass assignable
    protected $fillable = [
        'resource_type',
        'name',
        'email_address',
        'mobile_number',
        'birth_date',
        'gender',
        'personal_address',
        'institution_address',
        'preferred_segment',
        'class',
        'publisher_name',
        'contact_number',
        'resource_catalogue',
        'school_college_university_name',
        'student_enrollment',
        'summary',
    ];

    // Define any custom casts or date attributes if needed
    protected $casts = [
        'birth_date' => 'date',
    ];
}
