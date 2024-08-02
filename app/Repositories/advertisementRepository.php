<?php

namespace App\Repositories;

use App\Models\advertisement;
use App\Repositories\BaseRepository;

/**
 * Class advertisementRepository
 * @package App\Repositories
 * @version January 24, 2020, 5:27 am UTC
*/

class advertisementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'heading',
        'description'
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
        return advertisement::class;
    }
}
