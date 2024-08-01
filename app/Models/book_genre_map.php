<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="book_publisher",
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
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="publisher",
 *          description="publisher",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      )
 * )
 */
class book_genre_map extends Model
{

    public $table = 'bookgenres';
    
	/*
    public function admin()
    {
        return $this->hasOne('App\Models\admlogin', 'id', 'user_id');
    }
	*/

    public $fillable = [
        'book_id',
        'genre_id',
		'department_id',
		'subject_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'book_id' => 'integer',
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
        
    ];


	/*
	
	ALTER TABLE bookgenres MODIFY COLUMN book_id bigint(20), MODIFY COLUMN genre_id int(11);
	ALTER TABLE bookgenres ADD COLUMN department_id int(11) AFTER genre_id, ADD COLUMN subject_id int(11) AFTER department_id;
	
	*/
    
}
