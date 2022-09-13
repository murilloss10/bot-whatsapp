<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PersonalAccessToken.
 *
 * @package namespace App\Entities;
 */
class PersonalAccessToken extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * Indicates the table.
     *
     * @var string
     */
    public $table = 'personal_access_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tokenable_type', 'tokenable_id', 'name', 'token'];

}
