<?php

namespace App\Repositories;

use App\Models\video;
use App\Repositories\BaseRepository;

/**
 * Class videoRepository
 * @package App\Repositories
 * @version January 24, 2020, 12:30 pm UTC
*/

class videoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'materialupload_id',
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
        return video::class;
    }
}
