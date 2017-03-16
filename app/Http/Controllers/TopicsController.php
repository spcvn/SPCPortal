<?php

namespace SPCVN\Http\Controllers;


use SPCVN\Repositories\User\UserRepository;
use SPCVN\Repositories\Topic\TopicRepository;
use SPCVN\Repositories\Category\CategoryRepository;
use SPCVN\Http\Requests\Topic\CreateTopicRequest;
use SPCVN\Http\Requests\Topic\UpdateTopicRequest;
use SPCVN\Topic;
use SPCVN\User;
use SPCVN\Tag;
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
     * UsersController constructor.
     * @param UserRepository $users
     * @param TopicRepository $category
     */
    public function __construct(UserRepository $users, TopicRepository $topic)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topics = $this->topic->paginate(30, $request->input('search'));
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

            $dir = date('Y-m-d', time());
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
            $this->topic->setTags($topic->id, $request->input('tags'), false);
        }


        // upload document
        if ($request->hasFile('document')) {

            $dir = $this->topic->alphaID($topic->id, false, NUMBER_CHARACTER_RANDOM);
            $path = public_path().'/upload/documents/' . $dir;

            $document   = $request->file('document');
            $filename   = str_random(6).'.'.$document->getClientOriginalExtension();
            
            // save picture , not save to DB
            $document->move($path, $filename);  
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
    public function show($id)
    {
        //
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
        foreach ($topic->users as $mentor) {
            $userSelected[] = $mentor->id;
        }

        foreach ($topic->tags as $tag) {
            $tagsSelected[] = $tag->id;
        }

        return view('topic.create', compact('topic', 'categories', 'edit', 'users', 'user_login_id', 'userSelected', 'tags', 'tagsSelected'));
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

            $dir = date('Y-m-d', time());
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
        $this->topic->setTags($topic->id, $request->input('tags'), true);

        // upload document
        if ($request->hasFile('document')) {

            $dir = $this->topic->alphaID($topic->id, false, NUMBER_CHARACTER_RANDOM);
            $path = public_path().'/upload/documents/' . $dir;

            $document   = $request->file('document');
            $filename   = str_random(6).'.'.$document->getClientOriginalExtension();
            
            // save picture , not save to DB
            $document->move($path, $filename);  
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
    public function getMemtorsByTopicId($id)
    {
        $memtors = $this->topic->find($id);

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

        $pdfImg = 'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/pdf.png';
        $docImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Word.png';
        $pptImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20PowerPoint.png';
        $txtImg = 'http://cdn1.iconfinder.com/data/icons/CrystalClear/128x128/mimetypes/txt2.png';
        $xlsImg = 'http://cdn2.iconfinder.com/data/icons/sleekxp/Microsoft%20Office%202007%20Excel.png';
        $audioImg = 'http://cdn2.iconfinder.com/data/icons/oxygen/128x128/mimetypes/audio-x-pn-realaudio-plugin.png';
        $videoImg = 'http://cdn4.iconfinder.com/data/icons/Pretty_office_icon_part_2/128/video-file.png';
        $htmlImg = 'http://cdn1.iconfinder.com/data/icons/nuove/128x128/mimetypes/html.png';
        $fileImg = 'http://cdn3.iconfinder.com/data/icons/musthave/128/New.png';

        $listIcon = [
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

        return view('topic.document', compact('documents', 'documentExtention', 'listIcon'));
    }

    private function get_file_extension($f) {
        $ftype = pathinfo($f);
        return $extension = $ftype['extension'];
    }
}
