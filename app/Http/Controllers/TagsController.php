<?php

namespace SPCVN\Http\Controllers;

use Cache;
use SPCVN\Tag;
use SPCVN\Events\Tag\Created;
use SPCVN\Events\Tag\Deleted;
use SPCVN\Events\Tag\Updated;
use Illuminate\Support\Facades\Input;
use SPCVN\Http\Requests\Tag\CreateTagRequest;
use SPCVN\Http\Requests\Tag\UpdateTagRequest;
use SPCVN\Http\Requests\Tag\BaseTagRequest;
use SPCVN\Repositories\Tag\TagRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TagsController
 * @package SPCVN\Http\Controllers
 */
class TagsController extends Controller
{
    /**
     * @var TagsController
     */
    private $tags;

    /**
     * TagsController constructor.
     * @param TagsController $tags
     */
    public function __construct(TagRepository $tags)
    {
        // $this->middleware('permission:tags.manage');
        $this->tags = $tags;
    }

    /**
     * Display page with all available tags.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $perPage = 10;

        $tags = $this->tags->paginate($perPage, Input::get('search'));

        return view('tag.index', compact('tags'));
    }

    public function edit()
    {
        $edit = true;
    }

    /**
     * Display all data search
     */
    public function find(BaseTagRequest $request)
    {
        $tags = $this->tags->find($request->q);

        return response()->json($tags);
    }
}
