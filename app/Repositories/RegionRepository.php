<?php

namespace App\Repositories;

use App\Models\Region;
use App\Repositories\BaseRepository;


class RegionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'region_name',
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
        return Region::class;
    }
	
	// public function getPublisherBooks($id){
	// 	return $this->model::where('publisher_id', $id)->get(['id', 'year', 'book_name'])->toArray();
	// }
	
}