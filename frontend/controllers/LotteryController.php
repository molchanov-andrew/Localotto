<?php

namespace frontend\controllers;
use common\models\queries\BrokerQuery;
use common\models\records\Lottery;
use common\models\records\LotteryResult;
use frontend\helpers\OldHelper;
use frontend\models\route\Controller;
use yii\db\ActiveQuery;
use yii\filters\PageCache;

class LotteryController extends Controller
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
        $lottery = Lottery::find()->forLotteryPage()->one();
        $lotteryHeadBlock = $this->_renderLotteryHead($lottery);
        $rightBannerBlock = $this->_renderRightBannerBlock();

//        $monthlyResults = LotteryResult::find()
//            ->andWhere(['lotteryId' => \Yii::$app->pageData->pageContent->page->lotteryId])
//            ->monthlyThisYear()
//            ->all();
//        $yearlyResults = LotteryResult::find()
//            ->andWhere(['lotteryId' => \Yii::$app->pageData->pageContent->page->lotteryId])
//            ->yearly()
//            ->all();

        return $this->render('index',[
            'lottery' => $lottery,
            'lotteryHeadBlock' => $lotteryHeadBlock,
            'rightBannerBlock' => $rightBannerBlock,
        ]);
    }
}