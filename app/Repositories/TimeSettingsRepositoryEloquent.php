<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TimeSettingsRepository;
use App\Entities\TimeSettings;
use App\Validators\TimeSettingsValidator;

/**
 * Class TimeSettingsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TimeSettingsRepositoryEloquent extends BaseRepository implements TimeSettingsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TimeSettings::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TimeSettingsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
