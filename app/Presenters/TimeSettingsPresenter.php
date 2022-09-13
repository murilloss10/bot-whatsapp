<?php

namespace App\Presenters;

use App\Transformers\TimeSettingsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TimeSettingsPresenter.
 *
 * @package namespace App\Presenters;
 */
class TimeSettingsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TimeSettingsTransformer();
    }
}
