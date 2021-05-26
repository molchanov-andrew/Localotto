<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\PageContentQuery;
use common\models\records\Page;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class ToolsListController extends Controller
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
        $toolsPages = Page::find()->tools()->with(['pageContentByLanguage' => function(PageContentQuery $query){
            return $query->andWhere(['languageId' => \Yii::$app->pageData->pageContent->languageId])->with('image');
        }])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index',['toolsPages' => $toolsPages]);
    }
}