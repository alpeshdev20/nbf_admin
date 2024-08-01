<?php

namespace App\Repositories;

use App\Models\genresort;
use App\Repositories\BaseRepository;

/**
 * Class genresortRepository
 * @package App\Repositories
 * @version January 24, 2020, 11:11 am UTC
*/

class genresortRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genre_id',
        'sort'
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
        return genresort::class;
    }
}
