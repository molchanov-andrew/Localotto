<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\records\Bonus;
use common\models\records\Broker;
use common\models\records\Lottery;
use common\models\records\PaymentMethod;
use common\models\records\SourceMessage;
use frontend\models\route\Controller;
use frontend\models\search\BrokersTableSearch;
use Yii;
use yii\filters\PageCache;

class BrokersTableController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => PageCache::class,
                'only' => ['index'],
                'duration' => static::DEFAULT_CACHE_DURATION,
                'variations' => [
                    Yii::$app->language,
                    Yii::$app->request->get('page',1)
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new BrokersTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $bonuses = Bonus::find()->select(['id','name'])->all();
        array_walk($bonuses,function($value){
            $value->name = str_replace('<br>','',Yii::t(SourceMessage::CATEGORY_BONUSES,$value->name));
        });
        $lotteries = Lottery::find()->select(['id','name'])->all();
        array_walk($lotteries,function($value){
            $value->name = Yii::t(SourceMessage::CATEGORY_LOTTERIES,$value->name);
        });
        $paymentMethods = PaymentMethod::find()->select(['id','name'])->all();
        array_walk($paymentMethods,function($value){
            $value->name = Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$value->name);
        });

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lotteries' => $lotteries,
            'bonuses' => $bonuses,
            'paymentMethods' => $paymentMethods,
        ]);
    }
}