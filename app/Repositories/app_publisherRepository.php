<?php

namespace App\Repositories;

use App\Models\app_publisher;
use App\Repositories\BaseRepository;

/**
 * Class app_publisherRepository
 * @package App\Repositories
 * @version June 6, 2020, 10:43 am UTC
*/

class app_publisherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'company_name',
        'address',
        'city',
        'postal_code',
        'upload_address_proof',
        'pan_card',
        'aadhar_card',
        'gst_or_tin_card',
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'select_question',
        'security_answer',
        'check_box'
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
        return app_publisher::class;
    }
}
