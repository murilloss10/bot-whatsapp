<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TimeSettings.
 *
 * @package namespace App\Entities;
 */
class TimeSettings extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'start_hour', 'end_hour', 'start_interval', 'end_interval', 'day_name', 'day_number'
    ];

}
