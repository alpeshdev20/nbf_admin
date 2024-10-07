<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  


class Blog extends Model
{
    use SoftDeletes;  // Use the SoftDeletes trait

    protected $table = 'blogs';  // If your table name is 'blogs', this is not required.

    //primary key
    protected $primaryKey = 'id';

    // The attributes that are mass assignable (for protection against mass assignment)
    protected $fillable = [
        'title',
        'content',
        'slug',
        'is_published',
        'image',
    ];

    // Optionally, if you want to cast some fields to a specific type (e.g. boolean)
    protected $casts = [
        'is_published' => 'boolean',
    ];

    // If you need to define custom timestamps format
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

     /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required|max:255',             // Title must be required, a string, and no longer than 255 characters
        // 'content' => 'required',                  // Content must be required and a string
        'slug' => 'required|string|unique:blogs,slug|max:255', // Slug must be required, unique in the blogs table, and no longer than 255 characters
        'is_published' => 'required|boolean',            // is_published must be required and a boolean
        'published_at' => 'nullable|date',              // Published_at should be a valid date (optional)
    ];
}
