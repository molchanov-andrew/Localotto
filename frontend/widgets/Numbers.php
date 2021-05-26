<?php
namespace frontend\widgets;

use common\models\records\LotteryResult;

class Numbers extends \yii\jui\Widget
{
    const DEFAULT_CLASS = 'numbers-set';

    public $lotteryResult;

    public function init()
    {
        parent::init();
        if(!($this->lotteryResult instanceof LotteryResult)){
            throw new \Exception('$lotteryResult is not an instance of LotteryResult');
        }
    }

    public function run()
    {
        return $this->render('@app/views/widgets/numbers',['result' => $this->lotteryResult]);
    }
}