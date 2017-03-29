<?php

namespace SPCVN\Http\Controllers;

use Cache;
use SPCVN\Answer;
use Illuminate\Http\Request;
use SPCVN\Helpers\Output as Output;
use SPCVN\Repositories\Answer\AnswerRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AnswersController
 * @package SPCVN\Http\Controllers
 */
class AnswersController extends Controller
{
    /**
     * @var AnswerRepository
     */
    private $answers;

    /**
     * AnswersController constructor.
     * @param AnswerRepository $answers
     */
    public function __construct(AnswerRepository $answers)
    {
        $this->middleware('permission:questions.manage');
        $this->answers = $answers;
    }

    /**
     * Store newly created answer to database.
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $res = [];
        $answer = $this->answers->create($request->all());
        $user = ($answer->user)?$answer->user:'';
        $question = ($answer->question)?$answer->question:'';

        $res["answer"] = $answer;
        $res["user"] = $user;
        $res["question"] = $question;

        Output::__outputYes($res);
    }

    /**
     * Display for for editing specified role.
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $edit = true;

        return view('role.add-edit', compact('edit', 'role'));
    }

    /**
     * Update specified role with provided data.
     *
     * @param Role $role
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role->id, $request->all());

        return redirect()->route('role.index')
            ->withSuccess(trans('app.role_updated'));
    }

    /**
     * Remove specified role from system.
     *
     * @param Role $role
     * @param UserRepository $userRepository
     * @return mixed
     */
    public function delete(Role $role, UserRepository $userRepository)
    {
        if (! $role->removable) {
            throw new NotFoundHttpException;
        }

        $userRole = $this->roles->findByName('User');

        $userRepository->switchRolesForUsers($role->id, $userRole->id);

        $this->roles->delete($role->id);

        Cache::flush();

        return redirect()->route('role.index')
            ->withSuccess(trans('app.role_deleted'));
    }
}
