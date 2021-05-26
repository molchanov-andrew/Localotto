<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Lottery;
use frontend\models\route\Controller;
use yii\db\ActiveQuery;
use yii\filters\PageCache;

class BuyOnlineTableController extends Controller
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
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $lotteries = Lottery::find()->joinWithBuyOnlinePage(\Yii::$app->pageData->currentLanguage->id)->with([
            'logoImage',
            'country' => function(ActiveQuery $query){
                return $query->with(['currency','image']);
            },
        ])->published()->all();
        return $this->render('index',['lotteries' => $lotteries]);
    }
}