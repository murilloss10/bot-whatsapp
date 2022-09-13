<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TimeSettings;

/**
 * Class TimeSettingsTransformer.
 *
 * @package namespace App\Transformers;
 */
class TimeSettingsTransformer extends TransformerAbstract
{
    /**
     * Transform the TimeSettings entity.
     *
     * @param \App\Entities\TimeSettings $model
     *
     * @return array
     */
    public function transform(TimeSettings $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
