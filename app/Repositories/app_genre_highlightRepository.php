<?php

namespace App\Repositories;

use App\Models\app_genre_highlight;
use App\Repositories\BaseRepository;

/**
 * Class app_genre_highlightRepository
 * @package App\Repositories
 * @version March 19, 2020, 6:51 am UTC
*/

class app_genre_highlightRepository extends BaseRepository
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
        return app_genre_highlight::class;
    }
}
