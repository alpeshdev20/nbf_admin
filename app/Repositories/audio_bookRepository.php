<?php

namespace App\Repositories;

use App\Models\audio_book;
use App\Repositories\BaseRepository;

/**
 * Class audio_bookRepository
 * @package App\Repositories
 * @version January 24, 2020, 12:31 pm UTC
*/

class audio_bookRepository extends BaseRepository
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
        return audio_book::class;
    }
}
