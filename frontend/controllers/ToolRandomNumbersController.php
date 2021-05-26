<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Lottery;
use common\models\records\SourceMessage;
use frontend\models\route\Controller;
use Yii;
use yii\db\ActiveQuery;
use yii\filters\PageCache;
use yii\web\Response;

class ToolRandomNumbersController extends Controller
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
        $lotteries = Lottery::find()->with([
            'buyOnlinePage' => function(PageQuery $query){
                return $query->with(['pageContentByLanguage' => function(PageContentQuery $query){
                    return $query->andWhere(['languageId' => Yii::$app->pageData->pageContent->languageId])->published();
                }]);
            },
        ])->all();
        $rightBannerBlock = $this->_renderRightBannerBlock();
        return $this->render('index',['lotteries' => $lotteries, 'rightBannerBlock' => $rightBannerBlock]);
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }


    public function actionResult()
    {
        Yii::$app->controller->enableCsrfValidation = false;
        $request = Yii::$app->request;
        if($request->isAjax && $request->post()) {
            if( ($prom = $request->post('promoting_broker_id',null)) !== null &&
                ($def = $request->post('default_broker_id',null)) !== null &&
                ($lottery_id = $request->post('lottery_id',null)) !== null &&
                ($lang_code = $request->post('lang_code',null)) !== null ) {

                $url = '';

                $lottery = Lottery::find()->andWhere(['id' => $lottery_id])->with(['brokerToLotteries'=> function(ActiveQuery $query)use($prom,$def){
                    return $query->andWhere(['brokerId' => array_merge([$prom],[$def])])->indexBy('brokerId');
                }])->one();

                /** @var Lottery $lottery */
                if($lottery !== null){
                    if(isset($lottery->brokerToLotteries[$prom])) {
                        $url = $lottery->brokerToLotteries[$prom]->url;
                    } elseif(isset($lottery->brokerToLotteries[$def])) {
                        $url = $lottery->brokerToLotteries[$def]->url;
                    }
                }
                if(empty($url)){
                    return false;
                }

                $data['href'] = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $url, [], $lang_code);
                $data['text'] = Yii::t(SourceMessage::CATEGORY_GENERAL,'Play Now', [], $lang_code);
                return json_encode($data);
            }
        }

        return false;
    }
}