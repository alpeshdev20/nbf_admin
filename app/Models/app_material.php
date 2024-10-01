<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class app_material
 * @package App\Models
 * @version March 13, 2020, 7:12 am UTC
 *
 * @property string book_name
 * @property string book_image
 * @property string publisher_id
 * @property string year
 * @property string book_pdf
 * @property string length
 * @property string summary
 * @property string tags
 * @property string author
 * @property string language
 * @property integer material_type
 * @property integer genre_id
 * @property integer department_id
 * @property integer subject_id
 */
class app_material extends Model
{

    public $table = 'books';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function analytics()
    {
        return $this->hasMany('App\Models\app_book_analytic', 'book_id', 'id');
    }

    public function bookpublisher()
    {
        return $this->hasOne('App\Models\book_publisher', 'id', 'publisher_id');
    }

    public function bookdepartment()
    {
        return $this->hasOne('App\Models\app_department', 'id', 'department_id');
    }

    public function booksubject()
    {
        return $this->hasOne('App\Models\app_subject', 'id', 'subject_id');
    }

    public function bookgenre()
    {
        return $this->hasOne('App\Models\genre', 'id', 'genre_id');
    }

    public function booklangugae()
    {
        return $this->hasOne('App\Models\language', 'id', 'language');
    }

    public function booktype()
    {
        return $this->hasOne('App\Models\material', 'id', 'material_type');
    }

    protected $primaryKey = 'id';

    protected $fillable = [
        'book_name',
        'book_image',
        'publisher',
        'material_type',
        'cover',
        'file',
        'title',
        'year',
        'isbn_code',
        'length',
        'year',
        'book_pdf',
        'length',
        'summary',
        'tags',
        'author',
        'language',
        'mat_category',
        'genre_name',
        'genre_id',
        'department_id',
        'subject_id',
        'summary',
        'publisher_id',
        'teacher_id',
        'age',
        'allow_region',
        'table_of_content',
        'author_detail',
        'content',
        'slug',
        'folder_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'book_name' => 'string',
        'book_image' => 'string',
        'publisher_id' => 'string',
        'year' => 'string',
        'book_pdf' => 'string',
        'length' => 'string',
        'summary' => 'string',
        'tags' => 'string',
        'author' => 'string',
        'language' => 'string',
        'material_type' => 'integer',
        'genre_id' => 'integer',
        'department_id' => 'integer',
        'subject_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'book_name' => 'required',
        'year' => 'required',
        'summary' => 'required',
        'tags' => 'required',
        'age' => 'required',
        'author' => 'required',
        // 'allow_region'=>'required',
        // 'table_of_content'=>'required',
        // 'author_detail'=>'required',
    ];


    public static function getMaterialCategories($onlyFree = false) {
        if($onlyFree) {
            return [ 0 => "Free"];
        } else {
            return [ 1 => "Basic", 2 => "Premium"];
        }
    }
    
    public static function getMaterialAllCategories() {
        return [0 => "Free", 1 => "Basic", 2 => "Premium"];
    }

}
