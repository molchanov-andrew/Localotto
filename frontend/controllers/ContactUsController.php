<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\records\ContactMessages;
use common\models\records\Language;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class ContactUsController extends Controller
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
        return $this->render('index');
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionForm()
    {
        if(\Yii::$app->request->post()){
            $languageIso = \Yii::$app->request->post('language',null);
            if(($language = Language::find()->andWhere(['iso' => $languageIso])->one()) !== null){
                $full_name = \Yii::$app->request->post('full_name',null);
                $email = \Yii::$app->request->post('email',null);
                $phone = \Yii::$app->request->post('phone',null);
                $message = \Yii::$app->request->post('message',null);
                /** @var Language $language */
                $model = new ContactMessages([
                    'siteName' => 'localotto',
                    'languageIso' => $language->iso,
                    'fullName' => $full_name,
                    'email' => $email,
                    'phone' => $phone,
                    'message' => $message,
                ]);
                if($model->save()){
                    return $this->renderAjax('thank-you-message');
                }
                return $this->renderAjax('error-message');

            }
        }
        return json_encode('Sending error');
    }
}