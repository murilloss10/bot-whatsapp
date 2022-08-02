<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SaveSessionRepository;
use App\Entities\SaveSession;
use App\Validators\SaveSessionValidator;

/**
 * Class SaveSessionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SaveSessionRepositoryEloquent extends BaseRepository implements SaveSessionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SaveSession::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SaveSessionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
