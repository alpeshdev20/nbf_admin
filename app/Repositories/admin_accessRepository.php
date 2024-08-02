<?php

namespace App\Repositories;

use App\Models\admin_access;
use App\Repositories\BaseRepository;

/**
 * Class admin_accessRepository
 * @package App\Repositories
 * @version July 3, 2020, 7:13 am UTC
*/

class admin_accessRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'access_role',
        'admin_id',
        'active'
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
        return admin_access::class;
    }
}
