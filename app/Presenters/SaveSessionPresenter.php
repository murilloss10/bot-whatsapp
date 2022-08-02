<?php

namespace App\Presenters;

use App\Transformers\SaveSessionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SaveSessionPresenter.
 *
 * @package namespace App\Presenters;
 */
class SaveSessionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SaveSessionTransformer();
    }
}
