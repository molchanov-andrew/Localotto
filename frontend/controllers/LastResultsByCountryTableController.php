<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\records\Broker;
use common\models\records\Lottery;
use common\models\records\Page;
use common\models\records\Setting;
use frontend\models\route\Controller;
use frontend\models\search\LastResultsLotteriesSearch;
use Yii;
use yii\db\ActiveQuery;
use yii\filters\PageCache;

class LastResultsByCountryTableController extends Controller
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
        $searchModel = new LastResultsLotteriesSearch();
        $dataProvider = $searchModel->search(array_merge(Yii::$app->request->queryParams,['countryId' => Yii::$app->pageData->pageContent->page->countryId]));
        $defaultBroker = Broker::find()->with(['brokerToLotteries' => function(ActiveQuery $query){
            return $query->indexBy('lotteryId');
        }])->andWhere(['id' => \Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]])->one();
        $promotingBroker = null;
        if(\Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID] !== \Yii::$app->pageData->pageContent->page->promotingBrokerId){
            $promotingBroker = Broker::find()->andWhere(['id' => \Yii::$app->pageData->pageContent->page->promotingBrokerId])->one();
        }

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'defaultBroker' => $defaultBroker,
            'promotingBroker' => $promotingBroker,
        ]);
    }
}