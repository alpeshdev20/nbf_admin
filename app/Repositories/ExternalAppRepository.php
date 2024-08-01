<?php

namespace App\Repositories;

use App\Models\ExternalApp;
use App\Repositories\BaseRepository;

/**
 * Class ExternalAppRepository
 * @package App\Repositories
 * @version March 15, 2021, 2:15 pm UTC
*/

class ExternalAppRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'url',
        'status'
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
        return ExternalApp::class;
    }
}
