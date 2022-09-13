<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PersonalAccessTokenRepository;
use App\Entities\PersonalAccessToken;
use App\Validators\PersonalAccessTokenValidator;

/**
 * Class PersonalAccessTokenRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PersonalAccessTokenRepositoryEloquent extends BaseRepository implements PersonalAccessTokenRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PersonalAccessToken::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
