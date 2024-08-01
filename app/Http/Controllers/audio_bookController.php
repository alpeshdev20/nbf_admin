<?php

namespace App\Http\Controllers;

use App\DataTables\audio_bookDataTable;
use App\Http\Requests;
use App\Http\Requests\Createaudio_bookRequest;
use App\Http\Requests\Updateaudio_bookRequest;
use App\Repositories\audio_bookRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;
use App\Models\sgenre;
use App\Models\material;
use App\Models\language;
use Validator;

class audio_bookController extends AppBaseController
{
    /** @var  audio_bookRepository */
    private $audioBookRepository;

    public function __construct(audio_bookRepository $audioBookRepo)
    {
        $this->audioBookRepository = $audioBookRepo;
    }

    /**
     * Display a listing of the audio_book.
     *
     * @param audio_bookDataTable $audioBookDataTable
     * @return Response
     */
    public function index(audio_bookDataTable $audioBookDataTable)
    {
        return $audioBookDataTable->render('audio_books.index');
    }

    /**
     * Show the form for creating a new audio_book.
     *
     * @return Response
     */
    public function create()
    {
        return view('audio_books.create');
    }

    /**
     * Store a newly created audio_book in storage.
     *
     * @param Createaudio_bookRequest $request
     *
     * @return Response
     */
    public function store(Createaudio_bookRequest $request)
    {
        $input = $request->all();

        $audioBook = $this->audioBookRepository->create($input);

        Flash::success('Audio Book saved successfully.');

        return redirect(route('audioBooks.index'));
    }

    /**
     * Display the specified audio_book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            Flash::error('Audio Book not found');

            return redirect(route('audioBooks.index'));
        }

        return view('audio_books.show')->with('audioBook', $audioBook);
    }

    /**
     * Show the form for editing the specified audio_book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            Flash::error('Audio Book not found');

            return redirect(route('audioBooks.index'));
        }


        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();

        return view('audio_books.edit')->with(array('genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata,'audioBook', $audioBook));
    }

    /**
     * Update the specified audio_book in storage.
     *
     * @param  int              $id
     * @param Updateaudio_bookRequest $request
     *
     * @return Response
     */
    public function update($id, Updateaudio_bookRequest $request)
    {
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            Flash::error('Audio Book not found');

            return redirect(route('audioBooks.index'));
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


        $audioBook = $this->audioBookRepository->update($input, $id);

        Flash::success('Audio Book updated successfully.');

        return redirect(route('audioBooks.index'));
    }

    /**
     * Remove the specified audio_book from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $audioBook = $this->audioBookRepository->find($id);

        if (empty($audioBook)) {
            Flash::error('Audio Book not found');

            return redirect(route('audioBooks.index'));
        }

        $this->audioBookRepository->delete($id);

        Flash::success('Audio Book deleted successfully.');

        return redirect(route('audioBooks.index'));
    }
}
