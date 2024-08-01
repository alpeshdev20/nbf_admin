<?php

namespace App\Repositories;

use App\Models\userfav;
use App\Repositories\BaseRepository;

/**
 * Class userfavRepository
 * @package App\Repositories
 * @version January 24, 2020, 11:01 am UTC
*/

class userfavRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'book_id'
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
        return userfav::class;
    }
}
