<?php

namespace App\Repositories;

use App\Models\sgenre;
use App\Repositories\BaseRepository;

/**
 * Class sgenreRepository
 * @package App\Repositories
 * @version January 23, 2020, 7:12 am UTC
*/

class sgenreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'genre',
        'subgenre'
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
        return sgenre::class;
    }
}
