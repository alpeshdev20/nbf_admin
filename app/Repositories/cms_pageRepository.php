<?php

namespace App\Repositories;

use App\Models\cms_page;
use App\Repositories\BaseRepository;

/**
 * Class cms_pageRepository
 * @package App\Repositories
 * @version July 17, 2020, 10:14 am UTC
*/

class cms_pageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'page_name',
        'content',
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
        return cms_page::class;
    }
}
