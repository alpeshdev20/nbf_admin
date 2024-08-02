<?php

namespace App\Repositories;

use App\Models\app_logos;
use App\Repositories\BaseRepository;

/**
 * Class app_logosRepository
 * @package App\Repositories
 * @version January 21, 2021, 8:32 am UTC
*/

class app_logosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'file_path',
        'text_1',
        'text_2',
        'text_3'
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
        return app_logos::class;
    }
}
