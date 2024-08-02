<?php

namespace App\Repositories;

use App\Models\admlogin;
use App\Repositories\BaseRepository;

/**
 * Class admloginRepository
 * @package App\Repositories
 * @version January 23, 2020, 6:23 am UTC
*/

class admloginRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
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
        return admlogin::class;
    }
}
