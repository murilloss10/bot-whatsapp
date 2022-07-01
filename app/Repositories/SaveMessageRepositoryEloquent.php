<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SaveMessageRepository;
use App\Entities\SaveMessage;
use App\Validators\SaveMessageValidator;

/**
 * Class SaveMessageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SaveMessageRepositoryEloquent extends BaseRepository implements SaveMessageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SaveMessage::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SaveMessageValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
