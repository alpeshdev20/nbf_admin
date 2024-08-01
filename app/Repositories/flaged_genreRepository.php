<?php

namespace App\Repositories;

use App\Models\flaged_genre;
use App\Repositories\BaseRepository;

/**
 * Class flaged_genreRepository
 * @package App\Repositories
 * @version January 24, 2020, 11:08 am UTC
*/

class flaged_genreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genre_id',
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
        return flaged_genre::class;
    }
}
