<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\records\Broker;
use common\models\records\Language;
use frontend\helpers\JsonCompareBrokersHelper;
use frontend\models\route\Controller;
use Yii;
use yii\filters\PageCache;

class CompareBrokersController extends Controller
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
                    \Yii::$app->request->post('compareBrokerId', null),
                ],
            ],
            [
                'class' => PageCache::class,
                'only' => ['get-broker'],
                'duration' => static::DEFAULT_CACHE_DURATION,
                'variations' => [
                    Yii::$app->request->post('language', null),
                    Yii::$app->request->post('broker_id', null),
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $rightBroker = null;
        $rightBrokerId = \Yii::$app->request->post('compareBrokerId', null);
        $brokersQuery = Broker::find()->withMuchRelatedData();
        if ($rightBrokerId !== null) {
            $result = $brokersQuery->andWhere(['id' => [\Yii::$app->pageData->settings['defaultBrokerId']->value, $rightBrokerId]])->indexBy('id')->published()->all();
            if (isset($result[$rightBrokerId])) {
                $rightBroker = $result[$rightBrokerId];
            }
            $leftBroker = $result[\Yii::$app->pageData->settings['defaultBrokerId']->value];
        } else {
            $leftBroker = $brokersQuery->andWhere(['id' => \Yii::$app->pageData->settings['defaultBrokerId']->value])->published()->one();
        }
        /* For selects. */
        $brokers = Broker::find()->select(['Broker.id', 'Broker.name'])->joinWith('reviewPage', true, 'INNER JOIN')->published()->all();

        $rightBannerBlock = $this->_renderRightBannerBlock();
        return $this->render('index', [
            'rightBannerBlock' => $rightBannerBlock,
            'brokers' => $brokers,
            'rightBroker' => $rightBroker,
            'leftBroker' => $leftBroker,
        ]);
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionGetBroker()
    {
        $languageIso = Yii::$app->request->post('language', null);
        if (($language = Language::find()->andWhere(['iso' => $languageIso])->one()) === null) {
            $language = Language::findOne(Language::FIRST_LANGUAGE_ID);
        }
        Yii::$app->pageData->setCurrentLanguage($language);
        $brokerId = Yii::$app->request->post('broker_id', null);
        $broker = Broker::find()->withMuchRelatedData()->andWhere(['id' => $brokerId])->published()->one();
        if ($broker === null) {
            return json_encode('Unknown broker.');
        }
        $data = JsonCompareBrokersHelper::initializeData($broker);
        return json_encode($data);
    }
}