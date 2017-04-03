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

define('TAG_NAME_EDITABLE','tag_name_editable');
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
        $this->middleware('permission:tags.manage', ['except' => 'find']);
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

        $tag["username"]=$tag->user->username;

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
        $tag_name=($request->name===TAG_NAME_EDITABLE)?$request->value:$request->name;
        $tag_id=($request->tag_id)?$request->tag_id:$request->pk;

        $tag=array();

        if($this->tags->checkExistsName($tag_name, $tag_id)) {

            Output::__outputExists();
        }

        if(!$tag=$this->tags->update($tag_id, $tag_name)) {

            Output::__outputNo();
        }

        $tag["username"]=$tag->user->username;

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
