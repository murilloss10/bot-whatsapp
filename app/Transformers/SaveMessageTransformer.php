<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SaveMessage;

/**
 * Class SaveMessageTransformer.
 *
 * @package namespace App\Transformers;
 */
class SaveMessageTransformer extends TransformerAbstract
{
    /**
     * Transform the SaveMessage entity.
     *
     * @param \App\Entities\SaveMessage $model
     *
     * @return array
     */
    public function transform(SaveMessage $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
