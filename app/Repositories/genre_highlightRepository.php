<?php

namespace App\Repositories;

use App\Models\genre_highlight;
use App\Repositories\BaseRepository;

/**
 * Class genre_highlightRepository
 * @package App\Repositories
 * @version March 19, 2020, 7:18 am UTC
*/

class genre_highlightRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genre'
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
        return genre_highlight::class;
    }
}
