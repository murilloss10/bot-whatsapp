<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MessagesRepository;
use App\Entities\Messages;
use App\Validators\MessagesValidator;

/**
 * Class MessagesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MessagesRepositoryEloquent extends BaseRepository implements MessagesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Messages::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
