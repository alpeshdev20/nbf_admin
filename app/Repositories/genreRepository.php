<?php

namespace App\Repositories;

use App\Models\genre;
use App\Repositories\BaseRepository;

/**
 * Class genreRepository
 * @package App\Repositories
 * @version January 23, 2020, 7:08 am UTC
*/

class genreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genre_name'
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
        return genre::class;
    }
}
