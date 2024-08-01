<?php

namespace App\Repositories;

use App\Models\Subscriber;
use App\Repositories\BaseRepository;

/**
 * Class SubscriberRepository
 * @package App\Repositories
 * @version August 8, 2020, 1:27 pm UTC
*/

class SubscriberRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
	    'user_id',
	    'subscription_id',
	    'plan_name',
	    'plan_validity'
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
        return Subscriber::class;
    }
}
