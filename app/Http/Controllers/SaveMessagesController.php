<?php

namespace App\Http\Controllers;

use App\Services\MensagemService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\SaveMessageCreateRequest;
use App\Http\Requests\SaveMessageUpdateRequest;
use App\Repositories\SaveMessageRepository;
use App\Validators\SaveMessageValidator;

/**
 * Class SaveMessagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class SaveMessagesController extends Controller
{
    /**
     * @var SaveMessageRepository
     */
    protected $repository;

    /**
     * @var SaveMessageValidator
     */
    protected $validator;

    protected $messageService;

    /**
     * SaveMessagesController constructor.
     *
     * @param SaveMessageRepository $repository
     * @param SaveMessageValidator $validator
     */
    public function __construct(SaveMessageRepository $repository, SaveMessageValidator $validator, MensagemService $messageService)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $saveMessages = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $saveMessages,
            ]);
        }

        return view('saveMessages.index', compact('saveMessages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveMessageCreateRequest $request
     *
     */
    public function store(SaveMessageCreateRequest $request)
    {
        try {

            $this->messageService->saveMessages($request->all());
//            return redirect()->back();
            return [
                'message' => 'Mensagem recebida.'
            ];

        } catch (ValidatorException $e) {

            return [
                'message' => $e->getMessageBag()
            ];

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
        $saveMessage = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $saveMessage,
            ]);
        }

        return view('saveMessages.show', compact('saveMessage'));
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
        $saveMessage = $this->repository->find($id);

        return view('saveMessages.edit', compact('saveMessage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SaveMessageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SaveMessageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $saveMessage = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SaveMessage updated.',
                'data'    => $saveMessage->toArray(),
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
                'message' => 'SaveMessage deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SaveMessage deleted.');
    }
}
