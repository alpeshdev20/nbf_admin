<?php

namespace App\Repositories;

use App\Models\app_user;
use App\Repositories\BaseRepository;

/**
 * Class app_userRepository
 * @package App\Repositories
 * @version July 3, 2020, 6:52 am UTC
*/

class app_userRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'mobile'
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
        return app_user::class;
    }
}
