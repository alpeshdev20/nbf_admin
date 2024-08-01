<?php

namespace App\Repositories;

use App\Models\School;
use App\Repositories\BaseRepository;

/**
 * Class SchoolRepository
 * @package App\Repositories
 * @version October 7, 2022, 1:50 am UTC
*/

class SchoolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_group',
        'name',
        'address',
        'city',
        'state',
        'country',
        'pin',
        'authorized'
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
        return School::class;
    }
}
