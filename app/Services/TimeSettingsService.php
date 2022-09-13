<?php
/**
 * Faz o gerenciamento de horários para recebimentos de mensagens ou acesso às mensagens do DialogFlow.
 * Created by PhpStorm
 * User: Murillo
 * Date: 19/08/2022
 * Time: 15:14
 */

namespace App\Services;

use App\Repositories\TimeSettingsRepository;

class TimeSettingsService
{
    /**
     * @var TimeSettingsRepository
     */
    private $timeSettingsRepository;

    /**
     * Construtor.
     */
    public function __construct(TimeSettingsRepository $timeSettingsRepository)
    {
        $this->timeSettingsRepository = $timeSettingsRepository;
    }

    /**
     * Salva os dados passados por parâmetro, de acordo com o id do usuário.
     *
     * @param $data
     * @param $user_id
     */
    public function save($data, $user_id)
    {
        $days = array(
            1 => 'Domingo',
            2 => 'Segunda-Feira',
            3 => 'Terça-Feira',
            4 => 'Quarta-Feira',
            5 => 'Quinta-Feira',
            6 => 'Sexta-Feira',
            7 => 'Sábado');

        $days_saved = [];

        foreach ($days as $key => $day){
            if ( ($data['day' . $key . '_start'] != null) && ($data['day' . $key . '_end'] != null) ){
                $setting = $this->checkIfExistsSetting($user_id, $key)->first();

                if ($setting == null){
                    $day_ = $this->createRegistryDay($user_id, $data['day' . $key . '_start'], $data['day' . $key . '_end'], $day, $key);
                    array_push($days_saved, $day_);
                } else {
                    $day_ = $this->updateRegistryDay($setting->id, $data['day' . $key . '_start'], $data['day' . $key . '_end']);
                    array_push($days_saved, $day_);
                }
            }
        }

        return $days_saved;
    }

    /**
     * Lista todas as configurações criadas de acordo com o id do usuário passado por parâmetro.
     *
     * @param $user_id
     */
    public function findTimeSettingsUser($user_id)
    {
        $load_settings = $this->timeSettingsRepository->findByField('user_id', $user_id);
        return $load_settings;
    }

    /**
     * Cria o registro do dia de acordo com o id do usuário.
     *
     * @param $user_id
     * @param $start_hour
     * @param $end_hour
     * @param $day_name
     * @param $day_number
     */
    public function createRegistryDay($user_id, $start_hour, $end_hour, $day_name, $day_number)
    {
        $day = $this->timeSettingsRepository->create([
            'user_id'       => $user_id,
            'start_hour'    => $start_hour,
            'end_hour'      => $end_hour,
            'day_name'      => $day_name,
            'day_number'    => $day_number
        ]);

        return $day;
    }

    /**
     * Atualiza os horários do registro do dia de acordo com o id.
     *
     * @param $id
     * @param $start_hour
     * @param $end_hour
     */
    public function updateRegistryDay($id, $start_hour, $end_hour)
    {
        $day = $this->timeSettingsRepository->update([
            'start_hour'    => $start_hour,
            'end_hour'      => $end_hour
        ], $id);

        return $day;
    }

    /**
     * Verifica se existe a configuração, de acordo com o dia e o id usuário.
     *
     * @param $user_id
     * @param $day
     */
    public function checkIfExistsSetting($user_id, $day)
    {
        $day_number = (int) $day;
        $setting    = $this->timeSettingsRepository->findWhere(array(
            'user_id'       => $user_id,
            'day_number'    => $day_number
        ));

        return $setting;
    }

    /**
     * Verifica se a hora e dia da semana passados por parâmetro está de acordo com os definidos no banco de dados.
     *
     * @param $user_id
     * @param $day_name
     * @param $day_time
     * @return array
     */
    public function checkIfTheDateIsCorrect($user_id, $day_name, $day_time)
    {
        $setting = $this->timeSettingsRepository->findWhere(array(
            'user_id'   => $user_id,
            'day_name'  => $day_name
        ));

        $day        = $setting->first();
        $start_hour = $day->start_hour;
        $end_hour   = $day->end_hour;

        if ($day_time >= $start_hour && $day_time <= $end_hour)
            return [
                'check'         => true,
                'start_hour'    => $start_hour,
                'end_hour'      => $end_hour,
                'day_number'    => $day->day_number
            ];
        else
            return [
                'check'         => false,
                'start_hour'    => $start_hour,
                'end_hour'      => $end_hour,
                'day_number'    => $day->day_number
            ];
    }

    /**
     * Exclui o registro do dia de acordo com o id.
     *
     * @param $id
     */
    public function deleteDay($id)
    {
        try {
            $this->timeSettingsRepository->delete($id);
            return response()->json([
                'success' => 'Registro do dia foi deletado com sucesso.'
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'error' => 'Registro do dia não pôde ser deletado.'
            ], 500);
        }

    }

}
