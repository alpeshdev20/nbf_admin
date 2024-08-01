<?php

namespace App\Repositories;

use App\Models\couponcodes;
use App\Repositories\BaseRepository;

/**
 * Class bookRepository
 * @package App\Repositories
 * @version January 24, 2020, 12:19 pm UTC
*/

class coupon_codeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'code',
        'expiry_date',
        'discount_percentage',
        'status'
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
        return couponcodes::class;
    }
}
