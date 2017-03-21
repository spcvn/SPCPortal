<?php

namespace SPCVN\Http\Controllers;

use SPCVN\Events\Category\Created;
use SPCVN\Events\Category\Deleted;
use SPCVN\Events\Category\Updated;
use SPCVN\Repositories\User\UserRepository;
use SPCVN\Repositories\Category\CategoryRepository;
use SPCVN\Http\Requests\Category\CreateCategoryRequest;
use SPCVN\Http\Requests\Category\UpdateCategoryRequest;
use SPCVN\Category;
use SPCVN\User;
use Auth;
use Authy;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var CategoryRepository
     */
    private $category;

    /**
     * UsersController constructor.
     * @param UserRepository $users
     * @param CategoryRepository $category
     */
    public function __construct(UserRepository $users, CategoryRepository $category)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->category->paginate(30, $request->input('search'));
        return view('category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $edit       = false;
        $categories = $this->category->makeCategoryMultiLevel();
        $user       = Auth::user();

        return view('category.create', compact('category', 'categories', 'edit', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $edit       = true;
        $user       = Auth::user();
        $categories = $this->category->makeCategoryMultiLevel($category->id);
        return view('category.create', compact('category', 'categories', 'edit', 'user'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $this->category->update($category->id, $request->all());

        // back to edit page
        if ($request->input('back')) {
            return redirect()->route('category.edit', $category->id)->withSuccess(trans('app.category_updated'));
        }

        return redirect()->route('category.list')->withSuccess(trans('app.category_updated'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {        
        $this->category->create($request->all());

        // back to edit page
        if ($request->input('back')) {
            return redirect()->route('category.create')->withSuccess(trans('app.category_created'));
        }

        return redirect()->route('category.list')->withSuccess(trans('app.category_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Delete category by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {

        $this->category->delete($category->id);
        return redirect()->route('category.list')->withSuccess(trans('app.category_deleted'));
    }

    /**
     * Update position of category by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePosition(Request $request)
    {
        if ($request->isMethod('post')){

            $ok = $this->category->updatePosition($request->input('cat'));
            if ($ok) {
                return response()->json(['message' => trans('app.category_updated')]);    
            } else {
                return response()->json(['message' => trans('app.category_updated_false')]);
            }
        } 
    }

    public function checkExists(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => trans('app.something_wrong')]);
        }

        $result = $this->category->checkExists($request->all());
        if ($result) {
            return response()->json(['status' => false, 'message' => trans('app.name_exists')]);
        }

        return response()->json(['status' => true, 'message' => '']);
    }

}
