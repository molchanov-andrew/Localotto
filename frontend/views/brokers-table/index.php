<?php

use common\models\records\Page;
use \common\models\records\SourceMessage;
use frontend\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\grid\GridView;
use \yii\helpers\Html;
use \common\models\records\Broker;

/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \frontend\models\search\BrokersTableSearch $searchModel */
/* @var \common\models\records\Lottery[] $lotteries */
/* @var \common\models\records\Bonus[] $bonuses */
/* @var \common\models\records\PaymentMethod[] $paymentMethods */
?>
<style>
    #brokers-filters{
        display: none;
    }
</style>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 brokers-table-container">
        <article>
            <?= Yii::$app->pageData->pageContent->content1; ?>
        </article>
        <?php Pjax::begin(['id' => 'pjax']); ?>
        <div class="filter table-filter row hidden-xs">
            <span><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Filter by'); ?></span><br>
            <?php $form = ActiveForm::begin([
                'action' => Yii::$app->pageData->pageContent->fullUrl,
                'method' => 'get',
            ]); ?>
<!--            <form id="searchOptionsFromBrokerTable">-->
                <?= $form->field($searchModel,'lottery',['template' => '{input}'])
                    ->dropDownList(array_column($lotteries,'name','id'), [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'lottories'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'tested',['template' => '{input}'])
                    ->dropDownList([
                        1 => Yii::t(SourceMessage::CATEGORY_GENERAL,'Yes'),
                        0 => Yii::t(SourceMessage::CATEGORY_GENERAL,'No')
                    ], [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_BROKER_STATUSES,'Tested'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'bonuses',['template' => '{input}'])
                    ->dropDownList(array_column($bonuses,'name','id'), [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Bonus'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'systematic',['template' => '{input}'])
                    ->dropDownList([
                        1 => Yii::t(SourceMessage::CATEGORY_GENERAL,'Yes'),
                        0 => Yii::t(SourceMessage::CATEGORY_GENERAL,'No')
                    ], [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'scan_ticket',['template' => '{input}'])
                    ->dropDownList([
                        1 => Yii::t(SourceMessage::CATEGORY_GENERAL,'Yes'),
                        0 => Yii::t(SourceMessage::CATEGORY_GENERAL,'No')
                    ], [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Scan ticket'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'syndicat',['template' => '{input}'])
                    ->dropDownList([
                        1 => Yii::t(SourceMessage::CATEGORY_GENERAL,'Yes'),
                        0 => Yii::t(SourceMessage::CATEGORY_GENERAL,'No')
                    ], [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'syndicat'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>

                <?= $form->field($searchModel,'paymentMethods',['template' => '{input}'])
                    ->dropDownList(array_column($paymentMethods,'name','id'), [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Deposit Methods'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>
                <?php $translatedLanguagesList = array_map(function($value){
                    return ['id' => $value->id, 'name' => Yii::t(SourceMessage::CATEGORY_LANGUAGES,$value->name)];
                },Yii::$app->pageData->languages); ?>
                <?= $form->field($searchModel,'languages',['template' => '{input}'])
                    ->dropDownList(array_column($translatedLanguagesList,'name','id'), [
                        'prompt' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Languages'),
                        'class' => 'col-log-3 col-xs-6 col-md-3 col-sm-3'])->label(false); ?>
<!--            </form>-->
            <span class=" search items pull-right" id="search-in-broker-table"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Find'); ?></span>
            <?php ActiveForm::end(); ?>
        </div>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--    'headerOptions' => ['class' => 'mobile-jackpot hidden-sm hidden-md hidden-lg', ],-->
            <?= GridView::widget([
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last'
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'filterUrl' => Yii::$app->pageData->pageContent->fullUrl,
                'columns' => [
                    // Status and logo.
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Html::tag('span',Yii::t(SourceMessage::CATEGORY_GENERAL,'Broker'),['class' => 'hidden-xs']) . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $result = Html::img(Yii::$app->imageManager->path($broker->status->listImage),['class' => 'testedBroker hidden-sm']);
                            $subResult = '<span class="hidden-xs">' . Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name) . '</span><br class="hidden-xs" />' .
                                Html::img(Yii::$app->imageManager->path($broker->image),[
                                   'class' => 'broker-image',
                                   'alt' => Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name),
                                ]);
                            $result .= (!empty($broker->site) && $broker->hasReviewPage()) ?
                                Html::a($subResult,Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$broker->site),[
                                    'class' => 'broker_description',
                                    'rel' => 'popover',
                                    'target' => 'blank',
                                    'data-html' => 'true',
                                    'data-content' => $broker->reviewPage->pageContentByLanguage->additionalDescription,
                                    'data-placement' => 'right'
                                ]) :
                                Html::tag('span',$subResult,[
                                    'class' => 'broker_description',
                                ]);
                            return $result;
                        },
                        'contentOptions' => [
                            'class' => 'main-page-brokers-logo',
                        ]
                    ],
                    // Lotteries.
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Lotteries') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $id = 0-$broker->id;
                            $countLotteries = count($broker->brokerToLotteries);
                            $name = Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name);
                            $tranlsation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'lottories');
                            if($countLotteries < 1){
                                $translation2 = Yii::t(SourceMessage::CATEGORY_GENERAL,'broker_no_lotteries_text');
                                $lotteriesList = "<p>{$translation2}</p>";
                                $preview = '<span class="no-icon"></span>';
                            } else {
                                $preview = "<img src='/public/img/lotto.png' alt='{$tranlsation1}'/>";
                                $lotteriesList = '';
                                foreach ($broker->brokerToLotteries as $brokerToLottery) {
                                    $link = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $brokerToLottery->url);
                                    $image = Yii::$app->imageManager->path($brokerToLottery->lottery->logoImage);
                                    $lotteryName = Yii::t(SourceMessage::CATEGORY_LOTTERIES,$brokerToLottery->lottery->name);
                                    $lotteriesList .= "<a href='{$link}' target='blank'><img src='{$image}' alt='{$lotteryName} - {$name}' width='110px'/></a>";
                                }
                            }

                            $result = <<<HTML
<div class="row mobile-contained-row expanded-line">
    <div class="col-xs-5 hidden-sm hidden-md hidden-lg mobile-title">
        {$tranlsation1}
    </div>
    <div class="col-no-width-mobile expanded-data lotteries-count">
        <span>{$countLotteries}</span><br>
        <a id="{$id}" class="lotteries hidden-xs" href="javascript:;" data-html="true" data-content="{$lotteriesList}" rel="popover" data-placement="bottom">
            {$preview}
        </a>
    </div>
</div>
HTML;
                            return $result;
                        },
                    ],
                    // Scan ticket mobile.
                    [
                        'headerOptions' => ['class' => 'mobile-field hidden-sm hidden-md hidden-lg', ],
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $insertion = $broker->scanTicket ? '<span class="yes-icon"></span>' : '<span class="no-icon"></span>';
                            $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'Scan ticket');
                            return <<<HTML
 <div class="row mobile-contained-row expanded-line">
    <div class="col-xs-5 hidden-sm hidden-md hidden-lg mobile-title">
        {$translation}
    </div>
    <div class="col-xs-7 col-sm-12 expanded-data">
        {$insertion}
    </div>
</div>
HTML;


                        },
                        'contentOptions' => [
                            'class' => 'hidden-sm hidden-md hidden-lg',
                        ]
                    ],
                    // Bonuses.
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Bonus') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $insertion = '<span class="no-icon"></span>';
                            if(!empty($broker->bonuses)){
                                $insertion = '';
                                foreach ($broker->bonuses as $bonus) {
                                    $insertion .= Html::tag('span',Yii::t(SourceMessage::CATEGORY_BONUSES,$bonus->name));
                                }
                            }
                            $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'Bonus');
                            return <<<HTML
<div class="row mobile-contained-row expanded-line">
    <div class="col-xs-5 hidden-sm hidden-md hidden-lg mobile-title">
        {$translation}
    </div>
    <div class="col-xs-7 col-sm-12 expanded-data">
        {$insertion}
    </div>
</div>
HTML;


                        },
                        'contentOptions' => [
                            'class' => 'row mobile-contained-row expanded-line',
                        ]
                    ],
                    // Mobile collapsible item.
                    [
                        'headerOptions' => ['class' => 'collapsing-buttons hidden-sm hidden-md hidden-lg', ],
                        'format' => 'raw',
                        'value' => function(Broker $broker){
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
                            'class' => 'brokers-table-collapser collapsing-buttons collapsible-mobile-menu one-line hidden-sm hidden-md hidden-lg expanded-line mt-20-mobile',
                        ]
                    ],
                    // Systematic mobile.
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic') .
                            Html::a('?','#',[
                                'class' => 'popover-toggle info',
                                'data-html' => 'true',
                                'data-content' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic is'),
                                'rel' => 'popover',
                                'data-placement' => 'bottom',
                                'data-trigger' => 'hover',
                            ]) . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $insertion = $broker->systematic ? '<span class="yes-icon"></span>' : '<span class="no-icon"></span>';
                            $translation = Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic');
                            return <<<HTML
<div class="row mobile-contained-row expanded-line">
    <div class="col-xs-5 hidden-sm hidden-md hidden-lg mobile-title">
        {$translation}
    </div>
    <div class="col-xs-7 col-sm-12 expanded-data">
        {$insertion}
    </div>
</div>
HTML;

                        },
                        'contentOptions' => [
                            'class' => 'mobile-collapsible',
                        ]

                    ],
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Scan ticket') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $insertion = $broker->scanTicket ? '<span class="yes-icon"></span>' : '<span class="no-icon"></span>';
                            return Html::tag('div',$insertion,['class' => 'row mobile-contained-row expanded-line']);
                        },
                        'contentOptions' => [
                            'class' => 'hidden-xs',
                        ]
                    ],
                    [
                        'header' => Yii::t(SourceMessage::CATEGORY_GENERAL,'syndicat') .
                            Html::a('?','#',[
                                'class' => 'popover-toggle info',
                                'data-html' => 'true',
                                'data-content' => Yii::t(SourceMessage::CATEGORY_GENERAL,'Syndicat is'),
                                'rel' => 'popover',
                                'data-placement' => 'bottom',
                                'data-trigger' => 'hover',
                            ]),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $insertion = $broker->syndicat ? '<span class="yes-icon"></span>' : '<span class="no-icon"></span>';

                            return Html::tag('div', $insertion, ['class' => 'col-xs-7 col-sm-12 expanded-data']);
                        },
                        'contentOptions' => [
                            'class' => 'mobile-collapsible',
                        ]
                    ],
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Deposit Methods') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $translation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Deposit Methods');
                            $count = count($broker->paymentMethods);
                            if($count === 0){
                                $insertion = '<span class="no-icon"></span>';
                            } else {
                                $subInsertion = '';
                                $subInsertion2 = '';
                                $index = 0;
                                foreach ($broker->paymentMethods as $paymentMethod) {
                                    $path = Yii::$app->imageManager->path($paymentMethod->image);
                                    $name = Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);
                                    $subInsertion .= "<img src='{$path}' alt='$name' width='55'>";

                                    if($index < 4){
                                        $subInsertion2 .= Html::img(Yii::$app->imageManager->path($paymentMethod->image),['width' => '55px', 'alt' => Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name)]);
                                    }
                                }
                                $insertion = <<<HTML
<span class="hidden-xs">{$count}</span><br class="hidden-xs">
<a class="hidden-xs popover-toggle" href="javascript:;" data-html="true" data-content="{$subInsertion}" rel="popover" data-placement="bottom" data-trigger="hover">
    <img src='/public/img/visa.png' alt='visa' width='20px'/>
</a>
<div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">{$subInsertion2}</div>
HTML;
                            }
                            $result = <<<HTML
<div class="row mobile-contained-row expanded-line">
    <div class="col-no-width-mobile mobile-title hidden-sm hidden-md hidden-lg">
        {$translation1}
    </div>
</div>
<div class="row mobile-contained-row expanded-line">
    <div class="col-no-width-mobile expanded-data">
        {$insertion}
    </div>
</div>
HTML;


                            return $result;
                        },
                        'contentOptions' => [
                            'class' => 'mobile-collapsible',
                        ]
                    ],
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Languages') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $translation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Languages');
                            $count = count($broker->languages);
                            if($count === 0){
                                $insertion = '<span class="no-icon"></span>';
                            } else {
                                $subInsertion = '';
                                $subInsertion2 = '';
                                $index = 0;
                                foreach ($broker->languages as $language) {
                                    $name = Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);
                                    $path = Yii::$app->imageManager->path($language->image);
                                    $subInsertion .=  "<img src='{$path}' alt='$name' width='30'>";

                                    if($index < 4){
                                        $subInsertion2 .= Html::img(Yii::$app->imageManager->path($language->image),['width' => '30px', 'alt' => Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name)]);
                                    }
                                }
                                $insertion = <<<HTML
<span class="hidden-xs">{$count}</span><br class="hidden-xs">
<a class="hidden-xs popover-toggle" href="javascript:;" data-html="true" data-content="{$subInsertion}" rel="popover" data-placement="bottom" data-trigger="hover">
    <img src='/public/img/languages.png' alt='{$translation1}' width='20px'/>
</a>
<div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">{$subInsertion2}</div>
HTML;
                            }
                            $result = <<<HTML
<div class="row mobile-contained-row expanded-line">
    <div class="col-no-width-mobile mobile-title hidden-sm hidden-md hidden-lg">
        {$translation1}
    </div>
</div>
<div class="row mobile-contained-row expanded-line">
    <div class="col-no-width-mobile expanded-data">
        {$insertion}
    </div>
</div>
HTML;


                            return $result;
                        },
                        'contentOptions' => [
                            'class' => 'mobile-collapsible',
                        ]
                    ],
                    [
                        'header' => Html::beginTag('div',['class' => 'th-inner']) . Yii::t(SourceMessage::CATEGORY_GENERAL,'Action') . Html::endTag('div'),
                        'format' => 'raw',
                        'value' => function(Broker $broker){
                            $reviewButton = '';
                            if($broker->hasReviewPage()){
                                $translation2 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review');
                                $reviewButton =  <<<HTML
<a class="mobile-single-link read-agent-review link" href="{$broker->reviewPage->pageContentByLanguage->fullUrl}">
    <span class="mobile-container">
        {$translation2}
        <span class="double-arrow"></span>
    </span>
</a>
HTML;
                            }
                            if(!empty($broker->site) && $broker->isPositive()){
                                $translation1 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Site');
                                $site = Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$broker->site);
                                $siteButton = <<<HTML
<a class="mobile-single-link agent-site button-red" href="{$site}" target="_blank" rel="nofollow">
    <span class="mobile-container">
        {$translation1}
        <span class="double-arrow"></span>
    </span>
</a>
HTML;

                            } else {
                                $translation3 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare with the top agent');
                                $translation4 = Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare');
                                $comparePage = Yii::$app->pageData->menuPages[Page::MODULE_COMPARE_BROKERS]->pageContentByLanguage->fullUrl;
                                $siteButton = <<<HMTL
<form action="{$comparePage}" method="post">
    <input type="hidden" name="compareBrokerId" value="{$broker->id}">
    <button type="submit"  class="mobile-single-link agent-site button-red" title="{$translation3}">
            <span class="mobile-container">
                {$translation4}
                <span class="double-arrow"></span>
            </span>
    </button>
</form>
HMTL;

                            }
                            $result = <<<HTML
<div class="expanded-line"></div>
{$reviewButton}
<br class="hidden-xs">
{$siteButton}
HTML;

                            return $result;
                        },
                        'contentOptions' => [
                            'class' => 'mobile-collapsible',
                        ]
                    ],
                ],
                'tableOptions' => [
                    'class' => 'compare-table table table-hover fixed-table-container',
                    'style' => 'text-align:center;'
                ],
                'rowOptions' => [
                    'class' => 'broker-table-item',
                ],
                'options' => [
                    'id' => 'brokers'
                ]
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
<div class="row">
    <div id="fixed-header-of-table" class="hidden-xs" style="opacity: 0;"></div>
</div>
<?php $this->registerJsFile('/public/js/brokersTable.js',['depends' => AppAsset::class]); ?>
<?php $this->registerJsFile('/public/js/pjaxTableUpdated.js',['depends' => AppAsset::class]); ?>
