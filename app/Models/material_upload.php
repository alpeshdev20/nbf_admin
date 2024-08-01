<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="material_upload",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="material_type",
 *          description="material_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cover",
 *          description="cover",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="file",
 *          description="file",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="author_name",
 *          description="author_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="publisher_name",
 *          description="publisher_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="publication_year",
 *          description="publication_year",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="genre",
 *          description="genre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="subgenre",
 *          description="subgenre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="language",
 *          description="language",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="length",
 *          description="length",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="isbn_code",
 *          description="isbn_code",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="summary",
 *          description="summary",
 *          type="string"
 *      )
 * )
 */
class material_upload extends Model
{

    public $table = 'material_upload';
    



    public $fillable = [
        'material_type',
        'cover',
        'file',
        'title',
        'author_name',
        'publisher_name',
        'publication_year',
        'genre',
        'subgenre',
        'language',
        'length',
        'isbn_code',
        'summary'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'material_type' => 'string',
        'cover' => 'string',
        'file' => 'string',
        'title' => 'string',
        'author_name' => 'string',
        'publisher_name' => 'string',
        'publication_year' => 'string',
        'genre' => 'string',
        'subgenre' => 'string',
        'language' => 'string',
        'length' => 'string',
        'isbn_code' => 'string',
        'summary' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
