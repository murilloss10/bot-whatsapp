<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\MessageHistory;

/**
 * Class MessageHistoryTransformer.
 *
 * @package namespace App\Transformers;
 */
class MessageHistoryTransformer extends TransformerAbstract
{
    /**
     * Transform the MessageHistory entity.
     *
     * @param \App\Entities\MessageHistory $model
     *
     * @return array
     */
    public function transform(MessageHistory $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
