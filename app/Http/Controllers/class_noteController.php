<?php

namespace App\Http\Controllers;

use App\DataTables\class_noteDataTable;
use App\Http\Requests;
use App\Http\Requests\Createclass_noteRequest;
use App\Http\Requests\Updateclass_noteRequest;
use App\Repositories\class_noteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;
use App\Models\sgenre;
use App\Models\material;
use App\Models\language;
use Validator;

class class_noteController extends AppBaseController
{
    /** @var  class_noteRepository */
    private $classNoteRepository;

    public function __construct(class_noteRepository $classNoteRepo)
    {
        $this->classNoteRepository = $classNoteRepo;
    }

    /**
     * Display a listing of the class_note.
     *
     * @param class_noteDataTable $classNoteDataTable
     * @return Response
     */
    public function index(class_noteDataTable $classNoteDataTable)
    {
        return $classNoteDataTable->render('class_notes.index');
    }

    /**
     * Show the form for creating a new class_note.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_notes.create');
    }

    /**
     * Store a newly created class_note in storage.
     *
     * @param Createclass_noteRequest $request
     *
     * @return Response
     */
    public function store(Createclass_noteRequest $request)
    {
        $input = $request->all();

        $classNote = $this->classNoteRepository->create($input);

        Flash::success('Class Note saved successfully.');

        return redirect(route('classNotes.index'));
    }

    /**
     * Display the specified class_note.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            Flash::error('Class Note not found');

            return redirect(route('classNotes.index'));
        }

        return view('class_notes.show')->with('classNote', $classNote);
    }

    /**
     * Show the form for editing the specified class_note.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            Flash::error('Class Note not found');

            return redirect(route('classNotes.index'));
        }


       

        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();

        return view('class_notes.edit')->with(array('genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata,'classNote', $classNote));
    }

    /**
     * Update the specified class_note in storage.
     *
     * @param  int              $id
     * @param Updateclass_noteRequest $request
     *
     * @return Response
     */
    public function update($id, Updateclass_noteRequest $request)
    {
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            Flash::error('Class Note not found');

            return redirect(route('classNotes.index'));
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
          'file' => 'mimes:pdf,PDF' // max 10000kb
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


        $classNote = $this->classNoteRepository->update($input, $id);

        Flash::success('Class Note updated successfully.');

        return redirect(route('classNotes.index'));
    }

    /**
     * Remove the specified class_note from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classNote = $this->classNoteRepository->find($id);

        if (empty($classNote)) {
            Flash::error('Class Note not found');

            return redirect(route('classNotes.index'));
        }

        $this->classNoteRepository->delete($id);

        Flash::success('Class Note deleted successfully.');

        return redirect(route('classNotes.index'));
    }
}
