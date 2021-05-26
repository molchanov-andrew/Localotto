<?php
/**
 * Date: 6/28/18
 */

namespace frontend\controllers;


use common\models\queries\LotteryQuery;
use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Broker;
use common\models\records\BrokerStatus;
use common\models\records\Lottery;
use common\models\records\LotteryResult;
use common\models\records\Page;
use common\models\records\Setting;
use frontend\models\route\Controller;
use yii\filters\PageCache;

class HomeController extends Controller
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

        $lotteries = Lottery::find()->selectAll()
            ->withReviewPage()
            ->withBuyOnlinePage()
            ->withLogo()
            ->withCountryData()
            ->limit(\Yii::$app->pageData->settings[Setting::COUNT_OF_LOTTERIES_ON_HOME_PAGE]->value)
            ->orderByPositions(\Yii::$app->pageData->currentLanguage->id)
            ->all();

        $brokers = Broker::find()->selectAll()
            ->withImage()
            ->withReviewPage()
            ->withStatus(BrokerStatus::MAIN_PAGE_IMAGE)
            ->limit(\Yii::$app->pageData->settings[Setting::COUNT_OF_BROKER_ON_HOME_PAGE]->value)
            ->orderByPositions(\Yii::$app->pageData->currentLanguage->id)
            ->all();

        $lastResults = LotteryResult::find()->with([
            'lottery' => function(LotteryQuery $query){
                return $query->withReviewPage()->withLogo();
            }
        ])->limit(\Yii::$app->pageData->settings[Setting::COUNT_OF_RESULTS_ON_HOME_PAGE]->value)
            ->orderBy(['date' => SORT_DESC, 'id' => SORT_DESC])
            ->groupBy('lotteryId')
            ->all();

        $articles = Page::find()->articles()->joinWith(['pageContentByLanguage' => function(PageContentQuery $query){
            return $query->andWhere(['languageId' => \Yii::$app->pageData->pageContent->languageId])->with('image')->published();
        }],true,'INNER JOIN')->orderBy(['created' => SORT_DESC])->limit(4)->all();

        return $this->render('index',[
            'lotteries' => $lotteries,
            'brokers' => $brokers,
            'lastResults' => $lastResults,
            'articles' => $articles,
            'mobileSliderLotteries' => $this->_renderMobileLotteries($lotteries),
            'mobileSliderAgents' => $this->_renderMobileBrokers($brokers),
            'mobileSliderResults' => $this->_renderMobileResults($lastResults),
        ]);
    }

    protected function _renderMobileLotteries($lotteries)
    {
        return $this->renderPartial('home-lotteries-carousel',['lotteries' => $lotteries]);
    }

    protected function _renderMobileBrokers($brokers)
    {
        return $this->renderPartial('home-brokers-carousel',['brokers' => $brokers]);
    }

    protected function _renderMobileResults($results)
    {
        return $this->renderPartial('home-results-carousel',['lastResults' => $results]);
    }
}