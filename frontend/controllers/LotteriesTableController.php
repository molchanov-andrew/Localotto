<?php

namespace frontend\controllers;

use frontend\models\search\LotteriesTableSearch;
use Yii;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class LotteriesTableController extends Controller
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
        $searchModel = new LotteriesTableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}