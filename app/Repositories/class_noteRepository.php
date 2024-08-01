<?php

namespace App\Repositories;

use App\Models\class_note;
use App\Repositories\BaseRepository;

/**
 * Class class_noteRepository
 * @package App\Repositories
 * @version January 24, 2020, 12:24 pm UTC
*/

class class_noteRepository extends BaseRepository
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
        return class_note::class;
    }
}
