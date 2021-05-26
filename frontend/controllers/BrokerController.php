<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\LotteryQuery;
use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Broker;
use frontend\helpers\OldHelper;
use frontend\models\route\Controller;
use yii\db\ActiveQuery;
use yii\filters\PageCache;

class BrokerController extends Controller
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
                    \Yii::$app->pageData->pageContent->page->brokerId
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        OldHelper::pregReplaceComplexScriptedTags();
        $broker = Broker::find()->selectAll()->withMuchRelatedData()->andWhere(['id' => \Yii::$app->pageData->pageContent->page->brokerId])->one();
        $rightBannerBlock = $this->_renderRightBannerBlock();
        return $this->render('index',['broker' => $broker, 'rightBannerBlock' => $rightBannerBlock]);
    }
}