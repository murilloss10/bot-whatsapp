<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SaveSession;

/**
 * Class SaveSessionTransformer.
 *
 * @package namespace App\Transformers;
 */
class SaveSessionTransformer extends TransformerAbstract
{
    /**
     * Transform the SaveSession entity.
     *
     * @param \App\Entities\SaveSession $model
     *
     * @return array
     */
    public function transform(SaveSession $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
