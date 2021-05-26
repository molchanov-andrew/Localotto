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

class LastResultsTableController extends Controller
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
                    Yii::$app->request->get('page',1)
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new LastResultsLotteriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $countriesResultsPages = Page::find()->countriesResultPages()->withCountry()->joinWithCurrentLanguagePageContent()->all();
        $defaultBroker = Broker::find()->select(['id','name'])->andWhere(['id' => \Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value])->one();
        if(\Yii::$app->pageData->pageContent->page->promotingBrokerId === \Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value){
            $promotingBroker = $defaultBroker;
        } else {
            $promotingBroker = Broker::find()->select(['id','name'])->andWhere(['id' => \Yii::$app->pageData->pageContent->page->promotingBrokerId])->one();
        }

        return $this->render('index',[
            'countriesResultsPages' => $countriesResultsPages,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'defaultBroker' => $defaultBroker,
            'promotingBroker' => $promotingBroker,
        ]);
    }
}