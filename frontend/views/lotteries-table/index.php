<?php

use common\models\records\Broker;
use common\models\records\Setting;
use \common\models\records\SourceMessage;
use frontend\assets\AppAsset;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\records\Lottery;
use \yii\helpers\Html;

/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \frontend\models\search\LotteriesTableSearch $searchModel */
?>
<style>
    #w0-filters{
        display: none;
    }
</style>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div id="lottories-table-change" class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <div class="row-mobile-only mobile-grey-content">
            <article class="mobile-container">
                <?= Yii::$app->pageData->pageContent->content1; ?>
            </article>
        </div>
        <?php Pjax::begin(['id' => 'pjax']); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'pager' => [
                'firstPageLabel' => 'First',
                'lastPageLabel'  => 'Last'
            ],
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'filterUrl' => Yii::$app->pageData->pageContent->fullUrl,
            'columns' => [
                // Logo + country.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottery'),['class' => 'hidden-xs']) . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery) {
                        $result = '';
                        $logoImagePath = $lottery->logoImage !== null ? Yii::$app->imageManager->path($lottery->logoImage) : null;
                        if($lottery->hasReviewPage()){
                            $result .= Html::a(
                                Html::tag('center',Html::img($logoImagePath,['alt' => $lottery->name])),
                                $lottery->reviewPage->pageContentByLanguage->fullUrl
                            );
                        } else {
                            $result .= Html::tag('center',Html::img($logoImagePath,['alt' => $lottery->name]));
                        }
                        $result .= Html::tag('center',Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name),['class' => 'country-name hidden-xs']);
                        return $result;
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-logo',
                    ]
                ],
                // Mobile jackpot.
                [
                    'headerOptions' => ['class' => 'mobile-jackpot hidden-sm hidden-md hidden-lg', ],
                    'format' => 'raw',
                    'value' => function(Lottery $lottery){
                        $result = '';
                        $result .= Html::tag('span','',['class' => 'jackpot-icon']);
                        $result .= Html::tag('span',$lottery->jackpot,[
                            'class' => 'counter money is-a-jackpot',
                            'data-special-currency-id' => $lottery->hasCurrency() ? $lottery->country->currency->id : null,
                        ]);
                        return $result;
                    },
                    'contentOptions' => function(Lottery $lottery){
                        return [
                            'class' => 'lottery-table-jackpot hidden-sm hidden-md hidden-lg',
                            'data-jackpot' => $lottery->jackpot,
                        ];
                    }
                ],
                // Mobile Buy online button.
                [
                    'headerOptions' => ['class' => 'mobile-field hidden-sm hidden-md hidden-lg'],
                    'format' => 'raw',
                    'value' => function(Lottery $lottery){
                        return isset($lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value]) ?
                            Html::a(Yii::t(SourceMessage::CATEGORY_GENERAL,'Buy now'),$lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value]->url,[
                            'class' => 'buy-button',
                            'rel' => 'nofollow',
                        ]) : '';
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-buy-button col-xs-4 hidden-sm hidden-md hidden-lg',
                    ],
                ],
                // Mobile timer.
                [
                    'headerOptions' => ['class' => 'collapsing-buttons hidden-sm hidden-md hidden-lg'],
                    'format' => 'raw',
                    'value' => function(Lottery $lottery){
                        return '<span class="timer-icon"></span>' .
                            '<span class="timer" time="'. $lottery->nextDraw .'">' . $lottery->nextDraw . '</span>';
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-next-draw col-xs-4 hidden-sm hidden-md hidden-lg',
                    ]

                ],
                // Mobile toggle content,
                [
                    'headerOptions' => ['class' => 'mobile-field hidden-sm hidden-md hidden-lg'],
                    'format' => 'raw',
                    'value' => function(Lottery $lottery){
                        $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'More info');
                        return <<<HTML
<div class="mobile-collapser" data-collapse-selector="td.mobile-collapsible" data-collapse-parent-selector="tr">
    <a href="javascript:;" class="collapsible-mobile-link" aria-expanded="false">
        <span class="mobile-container">
            <span class="collapsible-menu-title">{$translation}</span>
            <span class="collapsible-menu-arrow">
                <i class="glyphicon glyphicon-chevron-right"></i>
            </span>
        </span>
    </a>
</div>
HTML;

                    },
                    'contentOptions' => [
                        'class' => 'lotteries-table-collapser collapsing-buttons collapsible-mobile-menu one-line hidden-sm hidden-md hidden-lg',
                    ]
                ],
                // Country.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'country'),['class' => 'hidden-xs']) . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery){
                        if($lottery->country === null){
                            return;
                        }
                        return Html::img(Yii::$app->imageManager->path($lottery->country->image),['alt' => $lottery->country->name]).
                            Html::tag('center',Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name),['class' => 'country-name hidden-xs']);
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-country mobile-collapsible',
                    ]
                ],
                // Main numbers.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'numbers to guess') . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery) {
            $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'numbers to guess');
            $mainNumbers = $lottery->mainNumbersToCheck.' '.Yii::t(SourceMessage::CATEGORY_GENERAL,'from').' '.$lottery->mainNumbers;
            $mainDescription = $lottery->mainNumbersDescription === '' ? '' : '<br>' . Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->mainNumbersDescription);
                        $result = <<<HTML
<div class="row mobile-contained-row">
    <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
    {$translation}
    </div>
    <div class="col-xs-6 col-sm-12 expand-lottery-guess expanded-data">                                     
    {$mainNumbers} {$mainDescription}    
    </div>
</div>
HTML;

                        return $result;
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-guess mobile-collapsible',
                    ]

                ],
                // Additional numbers.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'additional numbers') . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery) {
                        $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'additional numbers');
                        $addNumbers = empty($lottery->addNumbers) ? Yii::t(SourceMessage::CATEGORY_GENERAL,'No Add. Numbers') :  $lottery->addNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL,'from') . ' ' . $lottery->addNumbers;
                        $addDescription = $lottery->addNumbersDescription === '' ? '' : '<br>' . Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->addNumbersDescription);
                        $result = <<<HTML
<div class="row mobile-contained-row">
    <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
        {$translation}
    </div>
    <div class="col-xs-6 col-sm-12 expand-lottery-numbers expanded-data">
        {$addNumbers} {$addDescription}
    </div>
</div>
HTML;

                        return $result;
                    },
                    'contentOptions' => [
                        'class' => 'lottery-table-numbers mobile-collapsible',
                    ]
                ],
                // Jackpot.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'next jackpots') . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery) {
                        return Html::tag('span',$lottery->jackpot,[
                            'class' => 'counter money is-a-jackpot',
                            'data-special-currency-id' => $lottery->hasCurrency() ? $lottery->country->currency->id : null,
                        ]);
                    },
                    'contentOptions' => function(Lottery $lottery){
                        return [
                            'class' => 'hidden-xs',
                            'data-jackpot' => $lottery->jackpot,
                        ];
                    }
                ],
                // Actions.
                [
                    'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'Action'),['class' => 'hidden-xs']) . Html::endTag('div'),
                    'format' => 'raw',
                    'value' => function(Lottery $lottery) {
                        $result = '';
                        if($lottery->hasReviewPage()) {
                            $translation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review');
                            $result .= <<<HTML
 <a class="button-for-mobile_2 link mobile-single-link" href="{$lottery->reviewPage->pageContentByLanguage->fullUrl}">
    <span class="mobile-container">
        {$translation1}
        <span class="double-arrow double-arrow-transparent visible-xs"></span>
    </span>
</a>
HTML;
                        }
                        if($lottery->hasBuyOnlinePage()) {
                            $translation2 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare Ticket Prices');
                            $title = Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);
                            $title .= ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL,'is offered by');
                            $title .= ' : ' . $lottery->brokerToLotteryCount;
                            $title .= ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL,'brokers');
                            $result .= <<<HTML
<a class="shadows-effect border-radius-effect button-red mobile-single-link"
   title="{$title}" href="{$lottery->buyOnlinePage->pageContentByLanguage->fullUrl}">
    <span class="mobile-container">
        {$translation2}
        <span class="double-arrow double-arrow-transparent visible-xs"></span>
    </span>
</a>
HTML;
                        }
                        return $result;
                    },
                    'contentOptions' => function(Lottery $lottery){
                        return [
                            'class' => 'lottery-table-buttons mobile-collapsible',
                            'data-jackpot' => $lottery->jackpot,
                        ];
                    }
                ],
            ],
            'options' => [
                'class' => 'bootstrap-table',
            ],
            'rowOptions' => [
                'class' => 'lottery-table-item'
            ],
            'tableOptions' => [
                'class' => 'compare-table table table-hover fixed-table-container',
                'style' => 'text-align:center;'
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <?= Yii::$app->pageData->pageContent->content2; ?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<div id="fixed-header-of-table" class="hidden-xs"></div>
<?php $this->registerJsFile('/public/js/pjaxTableUpdated.js',['depends' => AppAsset::class]); ?>