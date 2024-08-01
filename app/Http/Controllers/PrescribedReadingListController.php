<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_publisher;
use App\Models\prescribed_reading_list;
use App\Models\reading_list_item;
use App\Models\TeacherDetail;
use App\Models\School;
use App\Models\readingListToken;
use App\DataTables\prescribed_reading_listsDataTable;
use Illuminate\Support\Facades\Auth;
use Flash;
use DB;

// delete later
use App\Models\ULogin;
use App\Models\app_material;




class PrescribedReadingListController extends Controller
{
    
	public function getDetails(Request $request, $id){
		$data = ULogin::where('id', $id)->first();
		$school = $data->schoolName()->first()->name;
		$data = $data->toArray();
		$data['school'] = $school;
		$rl=prescribed_reading_list::where(['prescriber_id'=>$data['school_id'], 'level'=>$data['level']])->first()->id;
		$items = reading_list_item::where(['prescribed_reading_list_id'=>$rl])->get();
		$books=array();
		foreach($items as $item){
			$books[] = app_material::where(['id'=>$item->app_material_id])->first()->book_name;
		}
		$data['prescribed_list']=$books;
		return response()->json($data);
	}
	
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(prescribed_reading_listsDataTable $prescribed_reading_listsDataTable)
    {
        //
		return $prescribed_reading_listsDataTable->render('prescribed_reading_lists.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userEmail = Auth::user()->email;
        $TeacherDetail = TeacherDetail::where('email', $userEmail)->first();
		$pubs = book_publisher::orderBy('id')->pluck('publisher', 'id');
		$pubs = $pubs->toArray();
		$schools = School::orderBy('name')->pluck('name', 'id');
        $publisher_id = [];
		$level = array();
		for($i=1; $i<=12;$i++)$level[]=$i;
		return view("prescribed_reading_lists.create")->with(array('publishers'=>$pubs, 'schools'=>$schools, 'level'=>$level,'publisher_id'=> $publisher_id, 'TeacherDetail'=> $TeacherDetail));
    }
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
       $request->validate([
			'name'=>'required',
			'selected_ids'=>'required',
			'prescriber_id'=>'required',
			'level'=>'required'
	   ]);
	   
        $prescriberData = [
            'name' => $request->name,
            'prescriber_id' => $request->prescriber_id,
            'prescriber' => $request->prescriber,
            'publisher_id' => null,
            'teacher_id' => null,    
            'level' => $request->level,
        ];
        
        if (isset($request->publisher_id)) {
            $prescriberData['publisher_id'] = $request->publisher_id;
        } elseif (isset($request->teacher_id)) {
            $prescriberData['teacher_id'] = $request->teacher_id;
        }
        $prlId = prescribed_reading_list::create($prescriberData)->id;

	   $bookIds = explode("|", $request->selected_ids);

	   foreach ($bookIds as $id){
			reading_list_item::create([
				'prescribed_reading_list_id'=>$prlId,
				'app_material_id'=>$id
			]);
	   }
	   
	   Flash::success('Reading list created successfully.');

       return redirect(route('prescribedReadingLists.index'));
	   
	   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\prescribed_reading_list  $prescribed_reading_list
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$rl = prescribed_reading_list::find($id);
		if (empty($rl)) {
            Flash::error('Readling list not found');

            return redirect(route('prescribedReadingLists.index'));
        }
        return view('prescribed_reading_lists.show')->with(['readList'=>$rl]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\prescribed_reading_list  $prescribed_reading_list
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userEmail = Auth::user()->email;
        $TeacherDetail = TeacherDetail::where('email', $userEmail)->first();
        $prlist = prescribed_reading_list::find($id);
        if(Auth::user()->access->access_role == 3) {
            $created_tokens = DB::table('pa_token')->where('reading_list_id',$id)->get();
            $readingList = readingListToken::where('reading_list_id', $prlist->id)->first();
            $token = isset($readingList->token) ? $readingList->token : null ;
        }
        $selected_book = reading_list_item::where("prescribed_reading_list_id",$id)->pluck("app_material_id");

        $pubs = book_publisher::orderBy('id')->pluck('publisher', 'id')->all();
		// $pubs = $pubs->toArray();
		$schools = School::orderBy('name')->pluck('name', 'id');
		$level = array();

        $get_publisher = reading_list_item::where("prescribed_reading_list_id",$id)->first();
        $get_publisher->app_material_id;

        $books = app_material::where("id",$get_publisher->app_material_id)->first();
        $publisher_id = $books->publisher_id;

		for($i=1; $i<=12;$i++)$level[]=$i;

        if (empty($prlist)) {
            Flash::error('App Logos not found');

            return redirect(route('appLogos.index'));
        }
        if(Auth::user()->access->access_role == 3) {
            return view('prescribed_reading_lists.edit')->with(array('token'=>$token, 'publishers'=>$pubs, 'schools'=>$schools, 'level'=>$level,'prlist'=>$prlist,'selected_books'=>$selected_book,'publisher_id'=> $publisher_id, 'TeacherDetail'=> $TeacherDetail, 'created_tokens'=>$created_tokens));
        }

        return view('prescribed_reading_lists.edit')->with(array('publishers'=>$pubs, 'schools'=>$schools, 'level'=>$level,'prlist'=>$prlist,'selected_books'=>$selected_book,'publisher_id'=> $publisher_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\prescribed_reading_list  $prescribed_reading_list
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
			'name'=>'required',
			'selected_ids'=>'required',
			'prescriber_id'=>'required',
			'level'=>'required'
	   ]);
	   
	   // create a new prescribed reading list entry and get id
       $prid =  prescribed_reading_list::find($id);
       $prid->name = $request->name;
        if (isset($request->publisher_id)) {
            $prid->prescriber_id = $request->prescriber_id;
        } elseif (isset($request->teacher_id)) {
            $prid->teacher_id = $request->teacher_id;
        }
       $prid->prescriber = $request->prescriber;
       $prid->level = $request->level;
       $prid->save();

	   
	   $bookIds = explode("|", $request->selected_ids);

       reading_list_item::where("prescribed_reading_list_id",$prid->id)->delete();

	   
	   foreach ($bookIds as $id){        
			reading_list_item::create([
				'prescribed_reading_list_id'=>$prid->id,
				'app_material_id'=>$id
			]);
	   }
	   
	   Flash::success('Reading list created successfully.');

       return redirect(route('prescribedReadingLists.index'));
	   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\prescribed_reading_list  $prescribed_reading_list
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        prescribed_reading_list::find($id)->delete();
        
        reading_list_item::where("prescribed_reading_list_id",$id)->delete();

        Flash::success('Reading list delete successfully.');

        return redirect(route('prescribedReadingLists.index'));
    }
}
