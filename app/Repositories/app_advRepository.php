<?php

namespace App\Repositories;

use App\Models\app_adv;
use App\Repositories\BaseRepository;

/**
 * Class app_advRepository
 * @package App\Repositories
 * @version June 29, 2020, 7:37 am UTC
*/

class app_advRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'image',
        'material',
        'active',
        'link',
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
        return app_adv::class;
    }
}
