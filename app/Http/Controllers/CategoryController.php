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

define('ITEMS_PER_PAGE', 30);

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
        $this->middleware('permission:category.manage');
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
        $page = (isset($request->page)) ? $request->page : 1;
        $pagination     = $this->category->paginate(ITEMS_PER_PAGE, $page, $request->input('search'));

        if ($request->input('search')) {
            $categories     = $this->prepareDataSearch($pagination);
        } else {
            $categories     = $this->prepareData($pagination);    
        }
        
        return view('category.list', compact('pagination', 'categories'));
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

        $notification = array(
            'alert-type'    =>  'success',
            'message'       =>  trans('app.category_updated')
        );

        // back to edit page
        if ($request->input('back')) {
            return redirect()->route('category.edit', $category->id)->with($notification);
        }

        return redirect()->route('category.list')->with($notification);
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

        $notification = array(
            'alert-type'    =>  'success',
            'message'       =>  trans('app.category_created')
        );

        // back to edit page
        if ($request->input('back')) {
            return redirect()->route('category.create')->with($notification);
        }

        return redirect()->route('category.list')->with($notification);
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
        $check = $this->category->checkExistsSub($category->id);
        if ($check) {

            $notification = array(
                'alert-type'    =>  'error',
                'message'       =>  trans('app.please_delete_sub_category')
            );

            return redirect()->route('category.list')->with($notification);    
        } else {
            $this->category->delete($category->id);

            $notification = array(
                'alert-type'    =>  'success',
                'message'       =>  trans('app.category_deleted')
            );
            
            return redirect()->route('category.list')->with($notification);    
        }
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

    public function ajaxUpdate(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => false]);
        }

        $data = $request->input();
        $category_id = $data['id'];
        unset($data['id']);

        $catetory = Category::find($category_id);
        $result = $catetory->update($data);

        if ($result) {
            return response()->json(['status' => true, 'message' => trans('app.category_updated')]);
        }

        return response()->json(['status' => false, 'message' => trans('app.name_exists')]);
    }

    public function prepareDataSearch($categories)
    {
        $results = $res = [];
        foreach ($categories as $key => $category) {
            $category   = json_decode(json_encode($category), True);
            $res[]      = array_reverse($category);
        }

        foreach ($res as $cats) {

            foreach ($cats as $cat) {
                if ($cat['parent_id'] == 0) {

                    if (! array_key_exists($cat['id'], $results)) {
                        $results[$cat['id']] = $cat;
                        $results[$cat['id']]['sub'] = $this->prepareSubDataSearch($cat['id'], $cats, $results[$cat['id']]); 
                    } else {
                        $this->prepareSubDataSearch($cat['id'], $cats, $results[$cat['id']]); 
                    }
                }
            }
        }

        return $results;
    }

    public function prepareSubDataSearch($catID, $datas, $results)
    {
        $category = [];
        foreach ($datas as $data) {

            if ($data['parent_id'] == $catID) {

                if (! array_key_exists($data['id'], $results)) {
                    $category[$data['id']] = $data;
                    $category[$data['id']]['sub'] = $this->prepareSubDataSearch($data['id'], $datas, $category[$data['id']]);    
                } else {
                    $this->prepareSubDataSearch($data['id'], $datas, $category[$data['id']]);
                }
            }
        }

        return $category;
    }

    public function prepareData($categories)
    {
        $results = [];
        foreach ($categories as $category) {

            $category = json_decode(json_encode($category), True);
            if ($category['parent_id'] == 0) {
                $results[$category['id']] = $category;
                $results[$category['id']]['sub'] = $this->prepareSubData($category['id'], $categories);
            }
        }

        return $results;
    }

    public function prepareSubData($catID, $datas)
    {
        $categories = [];
        foreach ($datas as $data) {

            $data = json_decode(json_encode($data), True);
            if ($data['parent_id'] == $catID) {
                $categories[$data['id']] = $data;
                $categories[$data['id']]['sub'] = $this->prepareSubData($data['id'], $datas);
            }
        }

        return $categories;
    }

}
