<?php

namespace App\Repositories;

use App\Models\material_upload;
use App\Repositories\BaseRepository;

/**
 * Class material_uploadRepository
 * @package App\Repositories
 * @version January 23, 2020, 1:30 pm UTC
*/

class material_uploadRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material_type',
        'cover',
        'file',
        'title',
        'author_name',
        'publisher_name',
        'publication_year',
        'genre',
        'subgenre',
        'language',
        'length',
        'isbn_code',
        'summary'
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
        return material_upload::class;
    }
}
