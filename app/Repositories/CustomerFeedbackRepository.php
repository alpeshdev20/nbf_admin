<?php

namespace App\Repositories;

use App\Models\CustomerFeedback;
use App\Repositories\BaseRepository;


class CustomerFeedbackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'feedback',
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
        return CustomerFeedback::class;
    }
	
	// public function getPublisherBooks($id){
	// 	return $this->model::where('publisher_id', $id)->get(['id', 'year', 'book_name'])->toArray();
	// }
	
}