<?php

namespace App\Repositories;

use App\Models\language;
use App\Repositories\BaseRepository;

/**
 * Class languageRepository
 * @package App\Repositories
 * @version January 23, 2020, 7:55 am UTC
*/

class languageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'language_name'
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
        return language::class;
    }
}
