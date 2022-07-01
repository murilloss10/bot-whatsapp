<?php

namespace App\Presenters;

use App\Transformers\SaveMessageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SaveMessagePresenter.
 *
 * @package namespace App\Presenters;
 */
class SaveMessagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SaveMessageTransformer();
    }
}
