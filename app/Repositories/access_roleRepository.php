<?php

namespace App\Repositories;

use App\Models\access_role;
use App\Repositories\BaseRepository;

/**
 * Class access_roleRepository
 * @package App\Repositories
 * @version July 3, 2020, 7:14 am UTC
*/

class access_roleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role'
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
        return access_role::class;
    }
}
