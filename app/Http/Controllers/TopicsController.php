<?php

namespace SPCVN\Http\Controllers;


use SPCVN\Repositories\User\UserRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use SPCVN\Repositories\Category\CategoryRepository;
use SPCVN\Repositories\Vote\VoteRepository;
use SPCVN\Http\Requests\Topic\CreateTopicRequest;
use SPCVN\Http\Requests\Topic\UpdateTopicRequest;
use SPCVN\Repositories\Question\QuestionRepository;
use SPCVN\Topic;
use SPCVN\User;
use SPCVN\Tag;
use SPCVN\Vote;
use Auth;
use Authy;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var TopicRepository
     */
    private $topic;

    /**
     * @var QuestionRepository
     */
    private $questions;

    /**
     * Constructor.
     * @param UserRepository $users
     * @param TopicRepository $category
     */
    public function __construct(UserRepository $users, TopicRepository $topic, QuestionRepository $questions)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->topic = $topic;
        $this->questions = $questions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = (isset($request->page)) ? $request->page : 1;
        $topics = $this->topic->paginate(30, $page, $request->input('search'));
        return view('topic.list', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic, CategoryRepository $categoryRepos)
    {
        $edit       = false;
        $users      = User::all()->pluck('full_name', 'id');
        $categories = $categoryRepos->makeCategoryMultiLevel();
        $user_login_id = Auth::id();
        $tags       = [];

        // redirect to category screen if the category does not exist
        if (count($categories) <= 1) { // first item is default
            return redirect()->route('category.list')->withWarning(trans('app.please_create_category_first'));
        }

        return view('topic.create', compact('topic', 'categories', 'edit', 'users', 'user_login_id', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTopicRequest $request)
    {
        // upload file
        if ($request->hasFile('picture')) {

            $dir = date('Y-m', time());
            $path = public_path().'/upload/topics/' . $dir;

            $photo      = $request->file('picture');
            $filename   = str_random(6).'.'.$photo->getClientOriginalExtension();

            // save picture
            $photo->move($path, $filename);

            // add picture name to request to save to DB
            $request->request->add(['picture' => $dir .'/'. $filename]);
        }

        // save topic
        $topic = $this->topic->create($request->input());

        // save topics_mentors if existed input request mentors
        if ($request->input('mentors')) {
            $this->topic->setMentors($topic->id, $request->input('mentors'), false);
        }

        // save topics_tags if existed input request tags
        if ($request->input('tags')) {
            $tagIDs = ($request->input('tags')) ? $request->input('tags') : '';
            if (!empty($tagIDs)) {
                $int_ids = array_filter($tagIDs, 'is_numeric');

                //check tag
                $tags = $this->questions->createNewTagIfNotExisis(Auth::id(), $tagIDs);

                //regist tagIDs
                $new_tag_ids = ($this->questions->setTagId($tags)) ? $this->questions->setTagId($tags) : $int_ids;

                $tag_ids_regist = '';
                if (!empty($int_ids)) {
                     $tag_ids_regist = array_merge($int_ids, $new_tag_ids);
                }

                $this->topic->setTags($topic->id, $tag_ids_regist, false);
            }
        }

        // upload document
        if ($request->hasFile('document')) {
            $this->uploadDocument($topic->id, $request);
        }

        // redirect to add new topic
        if ($request->input('back')) {
            return redirect()->route('topic.create')->withSuccess(trans('app.topic_created'));
        }


        // redirect to list topic
        return redirect()->route('topic.list')->withSuccess(trans('app.topic_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(Topic $topic)
    {
        $listIcon = $this->listIcon();
        return view('topic.detail', compact('topic', 'categories', 'edit', 'users', 'user_login_id', 'userSelected', 'tags', 'tagsSelected', 'documents', 'documentExtention', 'listIcon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic, CategoryRepository $categoryRepos)
    {
        $edit       = true;
        $users      = User::all()->pluck('full_name', 'id');
        $tags       = Tag::all()->pluck('name', 'id');
        $categories = $categoryRepos->makeCategoryMultiLevel();
        $user_login_id  = Auth::id();

        $tagsSelected = $userSelected = [];
        foreach ($topic->topics_mentors as $mentor) {
            $userSelected[] = $mentor->id;
        }

        foreach ($topic->topics_tags as $tag) {
            $tagsSelected[] = $tag->id;
        }

        // redirect to category screen if the category does not exist
        if (count($categories) <= 1) { // first item is default
            return redirect()->route('category.list')->withWarning(trans('app.please_create_category_first'));
        }

        // load document
        $dir        = $this->topic->alphaID($topic->id, false, NUMBER_CHARACTER_RANDOM);
        $documents  = Storage::files('/upload/documents/' . $dir);
        $documentExtention = [];
        foreach ($documents as $key => $document) {
            $documentExtention[$key] = $this->get_file_extension($document);
        }

        $listIcon = $this->listIcon();

        return view('topic.create', compact('topic', 'categories', 'edit', 'users', 'user_login_id', 'userSelected', 'tags', 'tagsSelected', 'documents', 'documentExtention', 'listIcon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic, UpdateTopicRequest $request)
    {

        // upload file
        if ($request->hasFile('picture')) {

            $dir = date('Y-m', time());
            $path = public_path().'/upload/topics/';

            $photo      = $request->file('picture');
            $filename   = str_random(6).'.'.$photo->getClientOriginalExtension();

            // save picture
            $photo->move($path . $dir, $filename);

            // add picture name to request to save to DB
            $request->request->add(['picture' => $dir .'/'. $filename]);

            // delete old picture
            if ($topic->picture) {
                @unlink($path .'/'. $topic->picture);
            }
        }

        // save topic
        $topic = $this->topic->update($topic->id, $request->input());

        // save topics_mentors if existed input request mentors
        $this->topic->setMentors($topic->id, $request->input('mentors'), true);
        // save topics_tags if existed input request tags
        //$this->topic->setTags($topic->id, $request->input('tags'), true);

        // save topics_tags if existed input request tags
        $tagIDs = ($request->input('tags')) ? $request->input('tags') : '';
        if (!empty($tagIDs)) {
            $int_ids = array_filter($tagIDs, 'is_numeric');

            //check tag
            $tags = $this->questions->createNewTagIfNotExisis(Auth::id(), $tagIDs);

            //regist tagIDs
            $new_tag_ids = ($this->questions->setTagId($tags)) ? $this->questions->setTagId($tags) : $int_ids;

            $tag_ids_regist = '';
            if (!empty($int_ids)) {
                 $tag_ids_regist = array_merge($int_ids, $new_tag_ids);
            }

            $this->topic->setTags($topic->id, $tag_ids_regist, true);
        } else {
            $this->topic->setTags($topic->id, $tagIDs, true);
        }


        // upload document
        if ($request->hasFile('document')) {
            $this->uploadDocument($topic->id, $request);
        }

        // back to edit page
        if ($request->input('back')) {
            return redirect()->route('topic.edit', $topic->id)->withSuccess(trans('app.topic_updated'));
        }

        // redirect to list topic
        return redirect()->route('topic.list')->withSuccess(trans('app.topic_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Topic $topic)
    {
        $this->topic->delete($topic->id);
        return redirect()->route('topic.list')->withSuccess(trans('app.topic_deleted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMentorsByTopicId(Request $request, UserRepository $userRepository)
    {
        $id=$request->topic_id;

        $memtors = $this->topic->getMemtorsByTopicId($id, $userRepository);

        return response()->json($memtors);
    }

    public function document(Topic $topic)
    {
        $dir        = $this->topic->alphaID($topic->id, false, NUMBER_CHARACTER_RANDOM);
        $documents  = Storage::files('/upload/documents/' . $dir);
        $documentExtention = [];
        foreach ($documents as $key => $document) {
            $documentExtention[$key] = $this->get_file_extension($document);
        }

        $listIcon = $this->listIcon();

        return view('topic.document', compact('documents', 'documentExtention', 'listIcon'));
    }

    private function listIcon()
    {
        $pdfImg = 'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/pdf.png';
        $docImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Word.png';
        $pptImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20PowerPoint.png';
        $txtImg = 'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/txt2.png';
        $xlsImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Excel.png';
        $audioImg = 'http://cdn2.iconfinder.com/data/icons/oxygen/128x128/mimetypes/audio-x-pn-realaudio-plugin.png';
        $videoImg = 'http://cdn4.iconfinder.com/data/icons/Pretty_office_icon_part_2/128/video-file.png';
        $htmlImg = 'http://cdn1.iconfinder.com/data/icons/nuove/128x128/mimetypes/html.png';
        $fileImg = 'http://cdn3.iconfinder.com/data/icons/musthave/128/New.png';

        return [
            'pdf' => $pdfImg,
            'doc' => $docImg,
            'docx' => $docImg,
            'txt' => $txtImg,
            'xls' => $xlsImg,
            'xlsx' => $xlsImg,
            'xlsm' => $xlsImg,
            'ppt' => $pptImg,
            'pptx' => $pptImg,
            'mp3' => $audioImg,
            'wmv' => $videoImg,
            'mp4' => $videoImg,
            'mpeg' => $videoImg,
            'html' => $htmlImg,
            'file' => $fileImg
        ];
    }

    private function get_file_extension($f) {
        $ftype = pathinfo($f);
        return $extension = $ftype['extension'];
    }

    /**
     * upload document
     *
     * @param int $topicID
     * @param array $request
     *
     * @return boolean
     * @since 2017.03.17
     * @version 1.0
     * @author Dinh Van Huong
     */
    private function uploadDocument($topicID, $request)
    {
        foreach ($request->document as $document) {
            $dir = $this->topic->alphaID($topicID, false, NUMBER_CHARACTER_RANDOM);
            $path = public_path().'/upload/documents/' . $dir;
            $filename   = str_random(6).'.'.$document->getClientOriginalExtension();

            // save picture , not save to DB
            $document->move($path, $filename);
        }

        return true;
    }

    public function checkExistsName(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => trans('app.something_wrong')]);
        }

        $result = $this->topic->checkExistsName($request->all());
        if ($result) {
            return response()->json(['status' => false, 'message' => trans('app.name_exists')]);
        }

        return response()->json(['status' => true, 'message' => '']);
    }

    public function votes(Request $request, VoteRepository $votesRepo)
    {
        // check ajax request
        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => trans('app.something_wrong')]);
        }

        // check existed data
        if ($votesRepo->checkExists($request->all())) {
            return response()->json(['status' => false, 'message' => trans('app.voted')]);   
        }

        // insert to DB
        if ($votesRepo->create($request->all())) {

            // update average vote for topic by id
            $votes      = $votesRepo->getVotesByTopicID($request->object_id);
            $average    = $sumVotes = 0;
            $numVotes   = count($votes);

            foreach ($votes as $vote) {
                $sumVotes += $vote->point;
            }

            $average    = ($sumVotes/$numVotes);
            $topic      = Topic::find($request->object_id);
            $topic->update(array('votes' => $average));

            return response()->json([
                'status' => true, 
                'message' => trans('app.votes_success'), 
                'item' => [
                    'object_id' =>  $request->object_id,
                    'average' => $average
                ]
            ]);
        }

        // default: return false
        return response()->json(['status' => false, 'message' => trans('app.something_wrong')]);
    }
}
