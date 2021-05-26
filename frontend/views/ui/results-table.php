<?php

use common\models\records\Setting;
use common\models\records\SourceMessage;
use \frontend\helpers\OldHelper;
use \yii\helpers\Html;
use \common\models\records\Lottery;
/* @var \common\models\records\Lottery[] $lotteries */
/* @var \common\models\records\Broker $promotingBroker */
/* @var \common\models\records\Broker $defaultBroker */
?>

<style>
    #w0-filters{
        display: none;
    }
</style>
<?= \yii\grid\GridView::widget([
    'pager' => [
        'firstPageLabel' => 'First',
        'lastPageLabel'  => 'Last'
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'filterUrl' => Yii::$app->pageData->pageContent->fullUrl,
    'columns' => [
        [
            'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'Logo'),['class' => 'hidden-xs']) . Html::endTag('div'),
            'format' => 'raw',
            'value' => function(Lottery $lottery){
                if($lottery->hasReviewPage()){
                    $result = Html::a(Html::img(Yii::$app->imageManager->path($lottery->logoImage),['alt' => $lottery->name]),$lottery->reviewPage->pageContentByLanguage->fullUrl);
                } else {
                    $result = Html::img(Yii::$app->imageManager->path($lottery->logoImage),['alt' => $lottery->name]);
                }
                return $result . '<br class="hidden-xs">
                <span class="hidden-xs">' . Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name) . '</span>';
            },
            'contentOptions' => ['class' => 'lottery-table-image']
        ],
        [
            'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'country'),['class' => 'hidden-xs']) . Html::endTag('div'),
            'format' => 'raw',
            'value' => function(Lottery $lottery){
                $result = Html::img(Yii::$app->imageManager->path($lottery->country->image),['alt' => Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name)]);
                return $result . '<br class="hidden-xs">
                <span>' . Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name) . '</span>';
            },
            'contentOptions' => ['class' => 'lottery-table-country']
        ],
        [
            'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Date') . Html::endTag('div'),
            'format' => 'raw',
            'value' => function(Lottery $lottery){
                return $lottery->latestLotteryResult === null ? Yii::t(SourceMessage::CATEGORY_GENERAL,'Coming soon') : '<span date="' . $lottery->latestLotteryResult->getNativeDatetime()->format('d-m-Y') . '">'
                    . OldHelper::formatResultsData($lottery->latestLotteryResult->getNativeDatetime()) .
               ' </span>';
            },
            'contentOptions' => ['class' => 'lottery-table-draw']
        ],
        [
            'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Numbers') . Html::endTag('div'),
            'format' => 'raw',
            'value' => function(Lottery $lottery){
                return $lottery->latestLotteryResult === null ?
                    Yii::t(SourceMessage::CATEGORY_GENERAL,'Coming soon') :
                    \frontend\widgets\Numbers::widget(['lotteryResult' => $lottery->latestLotteryResult]);
            },
            'contentOptions' => ['class' => 'lottery-table-numbers']
        ],
        [
            'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'Action'),['class' => 'hidden-xs']) . Html::endTag('div'),
            'format' => 'raw',
            'value' => function(Lottery $lottery) use ($promotingBroker, $defaultBroker) {
                $result = '';
                if($lottery->hasReviewPage()){
                    $translation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottery Info');
                    $result .= <<<HTML
<a class="button-for-mobile_2 mobile-single-link" href="{$lottery->reviewPage->pageContentByLanguage->fullUrl}">
    <span class="mobile-container">
        {$translation1} <span class="no-arrows hidden-xs">>></span>
        <span class="double-arrow double-arrow-purple"></span>
    </span>
</a>
HTML;

                }
                if($lottery->hasBuyOnlinePage()){
                    $translation2 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare Ticket Prices');
                    $result .= <<<HTML
<a class="shadows-effect border-radius-effect button-red mobile-single-link" href="{$lottery->buyOnlinePage->pageContentByLanguage->fullUrl}">
    <span class="mobile-container">        
       {$translation2}
        <span class="double-arrow"></span>
    </span>
</a>
HTML;

                }

                if(\Yii::$app->pageData->pageContent->page->promotingBrokerId !== \Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value && isset($lottery->brokerToLotteries[\Yii::$app->pageData->pageContent->page->promotingBrokerId])){
                    $translation3 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Play with') . Yii::t(SourceMessage::CATEGORY_BROKERS,$promotingBroker->name);
                    $translation4 = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$lottery->brokerToLotteries[\Yii::$app->pageData->pageContent->page->promotingBrokerId]->url);
                    $result .= <<<HTML
<a class="shadows-effect border-radius-effect button-red new-button-lotosend mobile-single-link" href="{$translation4}" target="_blank" rel="nofollow">
    <span class="mobile-container">
        {$translation3}
        <span class="double-arrow"></span>
    </span>
</a>
HTML;

                }

                if(isset($lottery->brokerToLotteries[\Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value])){
                    $translation5 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Play with') . Yii::t(SourceMessage::CATEGORY_BROKERS,$defaultBroker->name);
                    $translation6 = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$lottery->brokerToLotteries[\Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value]->url);
                    $result .= <<<HTML
<a class="shadows-effect border-radius-effect button-red new-button-thelotter mobile-single-link" href="{$translation6}" target="_blank" rel="nofollow">
    <span class="mobile-container">
        {$translation5}
        <span class="double-arrow"></span>
    </span>
</a>
HTML;

                }

                return Html::tag('div',$result,['class' => 'results-page-Action-buttons']);
            },
            'contentOptions' => ['class' => 'lottery-table-actions'],
        ],
    ],
    'options' => [
        'class' => 'bootstrap-table',
    ],
    'tableOptions' => [
        'class' => 'compare-table table results-table fixed-table-container',
        'style' => 'text-align:center;'
    ],
]); ?>
