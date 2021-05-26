<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use frontend\models\route\Controller;
use yii\filters\PageCache;

class ArticleController extends Controller
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
        $rightBannerBlock = $this->_renderRightBannerBlock();
        return $this->render('index', ['rightBannerBlock' => $rightBannerBlock]);
    }
}