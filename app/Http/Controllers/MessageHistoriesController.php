<?php

namespace App\Http\Controllers;

use App\Services\MensagemService;
use Illuminate\Http\Request;

use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class MessageHistoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessageHistoriesController extends Controller
{
    /**
     * @var
     */
    protected $messageService;

    public function __construct(MensagemService $messageService)
    {
        $this->messageService = $messageService;
    }


    public function store(Request $request)
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



}
