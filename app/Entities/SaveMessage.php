<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class SaveMessage.
 *
 * @package namespace App\Entities;
 */
class SaveMessage extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates the table.
     *
     * @var string
     */
    public $table = 'message_histories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'appPackageName', 'messengerPackageName', 'sender', 'message', 'ruleId', 'isTestMessage', 'for_user_id'];

}
