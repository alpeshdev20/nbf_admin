<?php

namespace App\Http\Controllers;

use App\DataTables\videoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatevideoRequest;
use App\Http\Requests\UpdatevideoRequest;
use App\Repositories\videoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;
use App\Models\sgenre;
use App\Models\material;
use App\Models\language;
use Validator;

class videoController extends AppBaseController
{
    /** @var  videoRepository */
    private $videoRepository;

    public function __construct(videoRepository $videoRepo)
    {
        $this->videoRepository = $videoRepo;
    }

    /**
     * Display a listing of the video.
     *
     * @param videoDataTable $videoDataTable
     * @return Response
     */
    public function index(videoDataTable $videoDataTable)
    {
        return $videoDataTable->render('videos.index');
    }

    /**
     * Show the form for creating a new video.
     *
     * @return Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created video in storage.
     *
     * @param CreatevideoRequest $request
     *
     * @return Response
     */
    public function store(CreatevideoRequest $request)
    {
        $input = $request->all();

        $video = $this->videoRepository->create($input);

        Flash::success('Video saved successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Display the specified video.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        return view('videos.show')->with('video', $video);
    }

    /**
     * Show the form for editing the specified video.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

       

        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();

        return view('videos.edit')->with(array('genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata,'video'=> $video));
    }

    /**
     * Update the specified video in storage.
     *
     * @param  int              $id
     * @param UpdatevideoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatevideoRequest $request)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        $input = $request->all();
        $file1 = $request->file('cover');  
        $fileName= $file1->getClientOriginalName();
     
        $fileName=str_replace(" ","_",$fileName);
       // return  $fileName;
        $file1->move(public_path('uploads/file'),$fileName);
        $input['cover']=$fileName;

        $file2 = $request->file('file');
         $fileArray = array('file' => $file2);
    
        // Tell the validator that this file should be an image
        $rules = array(
          'file' => 'required' // max 10000kb
        );   
        
        $validator = Validator::make($fileArray,$rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
              // Redirect or return json to frontend with a helpful message to inform the user 
              // that the provided file was not an adequate type
              return response()->json(['error' => $validator->errors()->getMessages()], 400);
        }
       
        $fileName1= $file2->getClientOriginalName();
       
        $fileextension =strtolower($file2->getClientOriginalExtension());
       

        $fileName1=str_replace(" ","_",$fileName1);
       // return $fileName1;
       
        $file2->move(public_path('uploads/file'),$fileName1);
        $input['file']=$fileName1;  


        $video = $this->videoRepository->update($input, $id);

        Flash::success('Video updated successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Remove the specified video from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $video = $this->videoRepository->find($id);

        if (empty($video)) {
            Flash::error('Video not found');

            return redirect(route('videos.index'));
        }

        $this->videoRepository->delete($id);

        Flash::success('Video deleted successfully.');

        return redirect(route('videos.index'));
    }
}
