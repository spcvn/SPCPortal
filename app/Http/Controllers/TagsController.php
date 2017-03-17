<?php

namespace SPCVN\Http\Controllers;

use Cache;
use SPCVN\Tag;
use SPCVN\Helpers\Output as Output;
use SPCVN\Events\Tag\Created;
use SPCVN\Events\Tag\Deleted;
use SPCVN\Events\Tag\Updated;
use Illuminate\Support\Facades\Input;
use SPCVN\Repositories\Tag\TagRepository;
use SPCVN\Http\Requests\Tag\CreateTagRequest;
use SPCVN\Http\Requests\Tag\UpdateTagRequest;
use SPCVN\Http\Requests\Tag\BaseTagRequest;
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
    private $data=[];

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

    /**
     * Display tag information
     *
     * @return json
     */
    public function edit(Tag $tag)
    {
        $tag=$this->tags->findById($tag->id);

        Output::__outputYes($tag);
    }

    /**
     * Store newly created tag to database.
     *
     * @param CreateTagRequest $request
     * @return mixed
     */
    public function store(CreateTagRequest $request)
    {
        if($this->tags->checkExistsName($request->name)) {

            Output::__outputExists();
        }

        $tag=$this->tags->create($request->all());

        Output::__outputYes($tag);
    }

    /**
     * Update tag to database.
     *
     * @param UpdateTagRequest $request
     * @return mixed
     */
    public function update(UpdateTagRequest $request)
    {
        if($this->tags->checkExistsName($request->name, $request->tag_id)) {

            Output::__outputExists();
        }

        if(!$tag=$this->tags->update($request->tag_id, $request->all())) {

            Output::__outputNo();
        }

        Output::__outputYes($tag);
    }

    /**
     * Display all data search
     *
     * @return json
     */
    public function find(BaseTagRequest $request)
    {
        $tags = $this->tags->find($request->q);

        return response()->json($tags);
    }

    /**
     * Delete the tag if it is removable.
     *
     * @param Tag $tag
     * @return mixed
     * @throws \Exception
     */
    public function delete(Tag $tag)
    {
        $this->tags->delete($tag->id);

        return redirect()->route('tag.index')
            ->withSuccess(trans('app.tag_deleted_successfully'));
    }
}
