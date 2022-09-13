<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Response;
use App\Http\Requests\TimeSettingsUpdateRequest;
use App\Services\TimeSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class TimeSettingsController.
 *
 * @package namespace App\Http\Controllers;
 */
class TimeSettingsController extends Controller
{
    /**
     * @var TimeSettingsService
     */
    protected $timeSettingsService;

    /**
     * TimeSettingsController constructor.
     *
     * @param TimeSettingsService $timeSettingsService
     */
    public function __construct(TimeSettingsService $timeSettingsService)
    {
        $this->timeSettingsService = $timeSettingsService;
    }

    /**
     * Exibe a página de definição de horários de cada dia da semana.
     */
    public function index(Request $request)
    {
        $day1       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 1)->first();
        $day2       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 2)->first();
        $day3       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 3)->first();
        $day4       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 4)->first();
        $day5       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 5)->first();
        $day6       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 6)->first();
        $day7       = $this->timeSettingsService->checkIfExistsSetting(Auth::id(), 7)->first();
        $success    = $request->session()->get('success');
        $error      = $request->session()->get('error');

        $request->session()->remove('success');
        $request->session()->remove('error');

        return view('hour-settings.index', compact('success', 'error', 'day1', 'day2', 'day3', 'day4', 'day5', 'day6', 'day7'));
    }

    /**
     * Salva as configurações de hora de cada dia da semana.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        $user_id    = Auth::id();
        $data       = $request->all();
        $settings   = $this->timeSettingsService->save($data, $user_id);
        $request->session()->put('success', 'Configurações salvas com sucesso.');

        return redirect()->back();
    }

    /**
     * Deleta permanentemente o registro do dia de acordo com o id.
     *
     * @param $id
     * @param Request $request
     */
    public function delete_day($id, Request $request)
    {
        try {
            $data = $this->timeSettingsService->deleteDay($id);
            $request->session()->put('success', 'Registro do dia foi deletado com sucesso.');
            return redirect()->back();
        } catch (\Exception $e) {
            $request->session()->put('error', 'Registro do dia não pôde ser deletado.');
            return redirect()->back();
        }
    }
}
