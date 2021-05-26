<?php
namespace frontend\controllers;

use common\models\records\Currency;
use common\models\records\Language;
use frontend\models\route\Controller;
use Yii;
use yii\filters\PageCache;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => PageCache::class,
                'only' => ['get-all-currencies'],
                'duration' => static::DEFAULT_CACHE_DURATION,
                'variations' => [
                    \Yii::$app->request->post('language', null),
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionGetAllCurrencies()
    {
        $languageIso = Yii::$app->request->post('language','en');
        $language = Language::find()->andWhere(['iso' => $languageIso])->one();
        if($language === null) {
            return false;
        }
        Yii::$app->pageData->setCurrentLanguage($language);
        $currencies = Currency::find()->indexBy('iso')->all();
        return $this->renderPartial('@app/views/ui/currencies',['currencies' => $currencies]);
    }
}
