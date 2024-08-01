<?php

namespace App\Repositories;

use App\Models\material;
use App\Repositories\BaseRepository;

/**
 * Class materialRepository
 * @package App\Repositories
 * @version January 23, 2020, 12:50 pm UTC
*/

class materialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material_type'
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
        return material::class;
    }
}
