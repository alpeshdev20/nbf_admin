<?php

namespace App\Http\Controllers;

use App\DataTables\bookDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatebookRequest;
use App\Http\Requests\UpdatebookRequest;
use App\Repositories\bookRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\genre;
use App\Models\sgenre;
use App\Models\material;
use App\Models\language;
use Validator;

class bookController extends AppBaseController
{
    /** @var  bookRepository */
    private $bookRepository;

    public function __construct(bookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the book.
     *
     * @param bookDataTable $bookDataTable
     * @return Response
     */
    public function index(bookDataTable $bookDataTable)
    {
        return $bookDataTable->render('books.index');
    }

    /**
     * Show the form for creating a new book.
     *
     * @return Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created book in storage.
     *
     * @param CreatebookRequest $request
     *
     * @return Response
     */
    public function store(CreatebookRequest $request)
    {
        $input = $request->all();

        $book = $this->bookRepository->create($input);

        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.show')->with('book', $book);
    }

    /**
     * Show the form for editing the specified book.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

      

        $genre = genre::orderBy('id')->pluck('genre_name', 'genre_name');
        $gdata = $genre->toArray();

        $sgenre = sgenre::orderBy('id')->pluck('subgenre', 'subgenre');
        // ->where('genre', '=', $gdata);
        $sgenredata = $sgenre->toArray();
        

        $lang = language::orderBy('id')->pluck('language_name', 'language_name');
   
        $ldata = $lang->toArray();

        return view('books.edit')->with(array('genre' => $gdata,'lang' =>$ldata,'sgenre'=>$sgenredata,'book'=>$book));
    }

    /**
     * Update the specified book in storage.
     *
     * @param  int              $id
     * @param UpdatebookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebookRequest $request)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
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


        $book = $this->bookRepository->update($input, $id);

        Flash::success('Book updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        $this->bookRepository->delete($id);

        Flash::success('Book deleted successfully.');

        return redirect(route('books.index'));
    }
}
