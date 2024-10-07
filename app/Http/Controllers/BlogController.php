<?php

namespace App\Http\Controllers;

use App\DataTables\BlogDatatable;
use App\Http\Requests\CreateBlog_pageRequest;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;



class BlogController extends Controller
{
    /** @var  BlogRepository */
    private $blogRepository;

    public function __construct(BlogRepository $BlogPageRepo)
    {
        $this->blogRepository = $BlogPageRepo;

          // Apply middleware to all methods
         $this->middleware('checkUserRole:1'); // Only allow access_role == 1
    }

    /**
     * Display a listing of the Blog_page.
     *
     * @param BlogDatatable $blogPageDataTable
     * @return Response
     */
    public function index(BlogDatatable $blogPageDataTable)
    {
        // dd(Auth::user()->access->access_role);
        return $blogPageDataTable->render('blogs.index');
    }

    /**
     * Show the form for creating a new Blog_page.
     *
     * @return Response
     */
    public function create()
    {
        $blog = new Blog(); // Empty model for creating a new blog
        return view('blogs.create', compact('blog'));
    }

    /**
     * Store a newly created Blog_page in storage.
     *
     * @param CreateBlog_pageRequest $request
     *
     * @return Response
     */
    public function store(CreateBlog_pageRequest  $request)
    {   
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max size
            'title' => 'required|string|max:255',             // Title must be required, a string, and no longer than 255 characters
            'content' => 'required|string',                  // Content must be required and a string
            'image' => 'required',
            'slug' => 'required|string|unique:blogs,slug|max:255', // Slug must be required, unique in the blogs table, and no longer than 255 characters
            'is_published' => 'required|boolean',            // is_published must be required and a boolean     
        ]);

        $input = $request->all();

        // Check if the file already exists in the directory
        if ($request->file('image')) {
            $file1 = $request->file('image');
            $fileName = $file1->getClientOriginalName();
            $fileName = str_replace(" ", "_", $fileName);
            $extension = $file1->getClientOriginalExtension();
            $uniqueFileName = time() . '_' . $fileName;
        
            // Create a unique filename using the current timestamp and original extension
            $uniqueFileName = time() . '_' . $fileName;
            // Move the file to the target directory
            
            // Define the upload directory
            $uploadDirectory = public_path('../../ebook/public/uploads/blogs');

                
            // Full path of the file to be uploaded
            $uploadPath = $uploadDirectory . '/' . $uniqueFileName;

            // Move the file to the target directory
            $file1->move($uploadDirectory, $uniqueFileName);

            // Set the file permissions to 777 after upload
            chmod($uploadPath, 0777);
        
            // Optional: Return a success message or handle the response
        }

        // Check if $input['image'] is set and unset it if needed
        if (isset($input['image'])) {
            unset($input['image']);
        }

        // Merge unique filenames into a single string or handle as needed
        $input['image'] = $uniqueFileName; // Use ',' or any delimiter as required        $blog = $this->blogRepository->create($input);

        $blog = $this->blogRepository->create($input);


        Flash::success('Blog Page saved successfully.');

        return redirect(route('blogs.index'));
    }

    /**
     * Display the specified Blog_page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $BlogPage = $this->blogRepository->find($id);

        if (empty($BlogPage)) {
            Flash::error('Blog Page not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.show')->with('BlogPage', $BlogPage);
    }

    /**
     * Show the form for editing the specified Blog_page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $blog = $this->blogRepository->find($id);

        if (empty($blog)) {
            Flash::error('Blog Page not found');

            return redirect(route('blogs.index'));
        }

        return view('blogs.edit')->with('blog', $blog);
    }

    /**
     * Update the specified Blog_page in storage.
     *
     * @param  int              $id
     * @param UpdateBlog_pageRequest $request
     *
     * @return Response
     */
    public function update($id, CreateBlog_pageRequest $request)
    {
        $BlogPage = $this->blogRepository->find($id);

        if (empty($BlogPage)) {
            Flash::error('Blog Page not found');

            return redirect(route('blogs.index'));
        }
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 2MB max size
            'title' => 'required|string|max:255',             // Title must be required, a string, and no longer than 255 characters
            'content' => 'required|string',                  // Content must be required and a string
            'image' => 'required',
            'slug' => 'required|string|unique:blogs,slug|max:255', // Slug must be required, unique in the blogs table, and no longer than 255 characters
            'is_published' => 'required|boolean',            // is_published must be required and a boolean   
        ]);
       
        $input = $request->all();

       

        // Check if the file already exists in the directory
        if ($request->file('image')) {
            $file1 = $request->file('image');
            $fileName = $file1->getClientOriginalName();
            $fileName = str_replace(" ", "_", $fileName);
            $extension = $file1->getClientOriginalExtension();
            $uniqueFileName = time() . '_' . $fileName;
        
            // Create a unique filename using the current timestamp and original extension
            $uniqueFileName = time() . '_' . $fileName;
            // Move the file to the target directory
            
            // Define the upload directory
            $uploadDirectory = public_path('../../ebook/public/uploads/blogs');

                
            // Full path of the file to be uploaded
            $uploadPath = $uploadDirectory . '/' . $uniqueFileName;

            // Move the file to the target directory
            $file1->move($uploadDirectory, $uniqueFileName);

            // Set the file permissions to 777 after upload
            chmod($uploadPath, 0777);
        
            // Optional: Return a success message or handle the response
        }

        // Check if $input['image'] is set and unset it if needed
        if (isset($input['image'])) {
            unset($input['image']);
        }

        // Merge unique filenames into a single string or handle as needed
        $input['image'] = $uniqueFileName; // Use ',' or any delimiter as required        $blog = $this->blogRepository->create($input);

        $BlogPage = $this->blogRepository->update($request->all(), $id);

        Flash::success('Blog Page updated successfully.');

        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified Blog_page from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // Find the blog post by its ID
        $BlogPage = $this->blogRepository->find($id);
    
        // Check if the blog post exists
        if (empty($BlogPage)) {
            Flash::error('Blog Page not found');
            return redirect(route('blogs.index'));
        }
    
        // Soft delete the blog post
        $BlogPage->delete();
    
        // Flash success message
        Flash::success('Blog Page deleted successfully.');
    
        // Redirect to the index page
        return redirect(route('blogs.index'));
    }
    

    //generate unique slug
    public function generateSlug(Request $request)
    {
        $title = $request->input('title');
        $existingSlug = $request->input('existing_slug');
    
        // Generate the initial slug
         $slug = Str::slug($title);

    
        // If in edit mode and the slug hasn't changed
        if ($existingSlug && $existingSlug === $slug) {
            return response()->json(['slug' => $slug]);
        }
    
        // Check for uniqueness and modify if necessary
        $originalSlug = $slug;
        $count = 1;
    
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
    
        return response()->json(['slug' => $slug]);
    }
}
