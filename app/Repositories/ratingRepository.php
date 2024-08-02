<?php

namespace App\Repositories;

use App\Models\rating;
use App\Repositories\BaseRepository;

/**
 * Class ratingRepository
 * @package App\Repositories
 * @version January 24, 2020, 11:10 am UTC
*/

class ratingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'book_id',
        'rating',
        'comment'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return rating::class;
    }
}
