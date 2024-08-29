<?php

namespace App\Repositories;

use App\Models\Subscription_plan;
use App\Repositories\BaseRepository;

/**
 * Class Subscription_planRepository
 * @package App\Repositories
 * @version August 8, 2020, 1:07 pm UTC
*/

class Subscription_planRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'description',
        'validity',
        'status',
        'plan_parent_category_id'
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
        return Subscription_plan::class;
    }
}
