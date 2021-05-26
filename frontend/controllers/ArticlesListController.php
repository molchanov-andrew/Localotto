<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\PageContentQuery;
use common\models\records\Page;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class ArticlesListController extends Controller
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
        $articlePages = Page::find()->articles()->joinWith(['pageContentByLanguage' => function(PageContentQuery $query){
            return $query->andWhere(['languageId' => \Yii::$app->pageData->pageContent->languageId])->with('image')->published();
        }],true,'INNER JOIN')->orderBy(['created' => SORT_DESC])->limit(50)->all();

        $rightBannerBlock = $this->_renderRightBannerBlock();

        return $this->render('index',['articlePages' => $articlePages, 'rightBannerBlock' => $rightBannerBlock]);
    }
}