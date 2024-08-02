<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;
use App\Repositories\RegionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\DataTables\RegionDataTable;
use App\Http\Requests\RegionReqeust;
use Flash;


class RegionController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $regionRepository;

    public function __construct(RegionRepository $regionRepo)
    {        
        $this->regionRepository = $regionRepo;
    }

    public function index(RegionDataTable $regionDataTable)
    {
        return $regionDataTable->render('regions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('regions.create');

        $country = DB::table('countries')->pluck('name','id');
        $country_data = Country::all();
        // $country_data = $country->toArray();


        $countries_id = [];

        return view('regions.create')->with(array('country_data' => $country_data,'countries_id'=>$countries_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'region_name' => 'required|unique:regions,region_name',
            'countries_id' => 'required'
    
        ]);

        if(isset($request->countries_id) && $request->countries_id != "")
        {
            $country_ids =  implode(",",$request->countries_id);
            $request->merge(['countries_id' => $country_ids]);
        }
        
        $input = $request->all();
        
        $continent_access = $this->regionRepository->create($input);

        Flash::success('Region saved successfully.');

        return redirect(route('region.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $regions = $this->regionRepository->find($id);

        if (empty($regions)) {
            Flash::error('region not found');

            return redirect(route('region.index'));
        }

        return view('regions.show')->with('region', $regions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region_data = $this->regionRepository->find($id);

        if (empty($region_data)) {
            Flash::error('Region Accesses not found');

            return redirect(route('regions.index'));
        }

        // $country_data = Country::orderBy('id')->pluck('name','id');
        $country_data = Country::all();

        $country = DB::table('countries')->pluck('name','id');
   
        $region_name = $region_data->region_name;
        $countries_id = $region_data->countries_id!= ""? explode(",",$region_data->countries_id):[];
        
        return view('regions.edit')->with(array('country_data' => $country_data,'country'=> $country,'region_data' => $region_data,'region_name'=>$region_name,'countries_id'=>$countries_id));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            Flash::error('Region data is not found');

            return redirect(route('region.index'));
        }
        
        $this->validate($request,[
            'region_name' => 'required|unique:regions,region_name,'.$id,
            'countries_id' => 'required'
    
        ]);

        $country_ids =  implode(",",$request->countries_id);
        $request->merge(['countries_id' => $country_ids]);
       

        $region = $this->regionRepository->update($request->all(), $id);

        Flash::success('Region data updated successfully.');

        return redirect(route('region.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = $this->regionRepository->find($id);

        if (empty($region)) {
            Flash::error('region not found');

            return redirect(route('region.index'));
        }

        $this->regionRepository->delete($id);

        Flash::success('region deleted successfully.');

        return redirect(route('region.index'));
    }

}