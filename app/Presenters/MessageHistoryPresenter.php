<?php

namespace App\Presenters;

use App\Transformers\MessageHistoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MessageHistoryPresenter.
 *
 * @package namespace App\Presenters;
 */
class MessageHistoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MessageHistoryTransformer();
    }
}
