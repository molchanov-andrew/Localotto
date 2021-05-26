<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\records\Lottery;
use frontend\helpers\OldHelper;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class BuyOnlineLotteryController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => PageCache::class,
                'only' => ['index'],
                'duration' => static::DEFAULT_CACHE_DURATION,
                'variations' => [
                    \Yii::$app->language,
                    \Yii::$app->pageData->pageContent->pageId
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        OldHelper::pregReplaceComplexScriptedTags();
        $lottery = Lottery::find()->selectAll()->andWhere(['id' => \Yii::$app->pageData->pageContent->page->lotteryId])->withBuyOnlineData()->published()->one();
        $lotteryHeadBlock = $this->_renderLotteryHead($lottery);
        return $this->render('index',['lottery' => $lottery, 'lotteryHeadBlock' => $lotteryHeadBlock]);
    }
}