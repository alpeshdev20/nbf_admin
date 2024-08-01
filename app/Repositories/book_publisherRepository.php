<?php

namespace App\Repositories;

use App\Models\book_publisher;
use App\Repositories\BaseRepository;

/**
 * Class book_publisherRepository
 * @package App\Repositories
 * @version July 17, 2020, 9:02 am UTC
*/

class book_publisherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'publisher',
        'active'
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
        return book_publisher::class;
    }
}
