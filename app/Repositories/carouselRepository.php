<?php

namespace App\Repositories;

use App\Models\carousel;
use App\Repositories\BaseRepository;

/**
 * Class carouselRepository
 * @package App\Repositories
 * @version January 24, 2020, 5:21 am UTC
*/

class carouselRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'banner_image'
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
        return carousel::class;
    }
}
