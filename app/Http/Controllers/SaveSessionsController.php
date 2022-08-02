<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SaveSessionCreateRequest;
use App\Http\Requests\SaveSessionUpdateRequest;
use App\Repositories\SaveSessionRepository;
use App\Validators\SaveSessionValidator;

/**
 * Class SaveSessionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class SaveSessionsController extends Controller
{
    /**
     * @var SaveSessionRepository
     */
    protected $repository;

    /**
     * @var SaveSessionValidator
     */
    protected $validator;

    /**
     * SaveSessionsController constructor.
     *
     * @param SaveSessionRepository $repository
     * @param SaveSessionValidator $validator
     */
    public function __construct(SaveSessionRepository $repository, SaveSessionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $saveSessions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $saveSessions,
            ]);
        }

        return view('saveSessions.index', compact('saveSessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveSessionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SaveSessionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $saveSession = $this->repository->create($request->all());

            $response = [
                'message' => 'SaveSession created.',
                'data'    => $saveSession->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saveSession = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $saveSession,
            ]);
        }

        return view('saveSessions.show', compact('saveSession'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saveSession = $this->repository->find($id);

        return view('saveSessions.edit', compact('saveSession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SaveSessionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SaveSessionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $saveSession = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SaveSession updated.',
                'data'    => $saveSession->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'SaveSession deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SaveSession deleted.');
    }
}
