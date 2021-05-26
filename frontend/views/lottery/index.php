<?php $i = 0; // Used for counting how much brokers shown in broker table and are we need pagination toggle.
use common\models\records\Setting;
use \common\models\records\SourceMessage;
use yii\helpers\Html;

/* @var \common\models\records\Page $hotNumbersPage - get it in controller. */
/* @var \common\models\records\Lottery $lottery */
?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= isset($lotteryHeadBlock) ? $lotteryHeadBlock : ''; ?>
                <article class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="edit"><?=Yii::$app->pageData->pageContent->content1;?></article>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
<!--        <section class="row">-->
<!--            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>-->
<!--            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">-->
<!--                <section class="row">-->
<!--                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 lotto-info-wit">-->
<!--                        <h2>-->
<!--                            --><?//= $lastResultString; ?>
<!--                        </h2>-->
<!--                        <hr class="hidden-xs" />-->
<!--                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">-->
<!--                            <div id="lotto-info">-->
<!--                                <div class="clearfix"></div>-->
<!--                                --><?//= isset($lastResultsHtml) ? $lastResultsHtml : ''; ?>
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!--                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">-->
<!--                            <div class="row">-->
<!--                                <div class="results-dropdown-container">-->
<!--                                    <input id="lotto_id" type="hidden" name="lotto_id" value="--><?//= $lottery->id; ?><!--">-->
<!--                                    <div id="showResults" class="dropdown collapsible-mobile-menu one-line">-->
<!--                                        <button id="selected_lottery" class="btn btn-default dropdown-toggle collapsible-mobile-link" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                                            <span class="mobile-container">-->
<!--                                                <span class="collapsible-menu-title">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'Other results'); ?><!--</span>-->
<!--                                                    <span class="collapsible-menu-arrow">-->
<!--                                                    <i class="glyphicon glyphicon-chevron-right"></i>-->
<!--                                                </span>-->
<!--                                                <span class="caret hidden-xs"></span>-->
<!--                                            </span>-->
<!--                                        </button>-->
<!--                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">-->
<!--                                            --><?php //if(isset($monthsAvailable[date('Y')])) :  ?>
<!--                                                <li class="dropdown-blue">-->
<!--                                                    <a class="mobile-single-link" data-link="--><?//= LotteryResultLink::generateLinkByParams([
//                                                        'language' => $page['iso'],
//                                                        'prefix' => $statsPage['url'],
//                                                        'lotteryLink' => $page['url'],
//                                                        'year' => date('Y')
//                                                    ]) ?><!--" href="javascript:;">-->
<!--                                                        <span class="mobile-container">-->
<!--                                                            --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'All Results for').' '.date('Y'); ?>
<!--                                                            <span class="double-arrow double-arrow-darkblue"></span>-->
<!--                                                        </span>-->
<!--                                                    </a>-->
<!--                                                </li>-->
<!--                                                <li class="dropdown-header">-->
<!--                                                    --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'by month:'); ?>
<!--                                                </li>-->
<!--                                                --><?php //foreach ($monthsAvailable[date('Y')] as $month) : ?>
<!--                                                    <li class="dropdown-blue">-->
<!--                                                        <a class="mobile-single-link" data-link="--><?//= LotteryResultLink::generateLinkByParams([
//                                                            'language' => $page['iso'],
//                                                            'prefix' => $statsPage['url'],
//                                                            'lotteryLink' => $page['url'],
//                                                            'year' => date('Y'),
//                                                            'month' => $month
//                                                        ]) ?><!--" href="javascript:;">-->
<!--                                                            <span class="mobile-container">-->
<!--                                                                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,Helper::getMonthString($month)).' '.date('Y') ?>
<!--                                                                <span class="double-arrow double-arrow-darkblue"></span>-->
<!--                                                            </span>-->
<!--                                                        </a>-->
<!--                                                    </li>-->
<!--                                                --><?php //endforeach; ?>
<!--                                                <li role="separator" class="divider"></li>-->
<!--                                            --><?php //endif; ?>
<!--                                            --><?php //if(isset($statisticsPages)) : ?>
<!--                                                --><?php //foreach ($statisticsPages as $statisticsPage): ?>
<!--                                                    --><?php //if($statisticsPage['year'] != date('Y')) : ?>
<!--                                                        <li class="dropdown-blue">-->
<!--                                                            <a class="mobile-single-link" data-link="--><?//= $statisticsPage['url']; ?><!--" href="javascript:;">-->
<!--                                                                <span class="mobile-container">-->
<!--                                                                    --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'Results for'); ?><!-- --><?//= $statisticsPage['year']; ?>
<!--                                                                    <span class="double-arrow double-arrow-darkblue"></span>-->
<!--                                                                </span>-->
<!--                                                            </a>-->
<!--                                                        </li>-->
<!--                                                    --><?php //endif; ?>
<!--                                                --><?php //endforeach; ?>
<!--                                            --><?php //endif; ?>
<!--                                        </ul>-->
<!--                                    </div>-->
<!--                                    --><?// if(isset($lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value])): ?>
<!--                                        <a class="hidden-xs" href="--><?//=Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value]->url);?><!--" target="_blank" rel="nofollow"><img class="buy-tickets" src="/public/img/label---><?//=strtolower(Translator::lang());?><!--.png" alt="--><?//=Yii::t(SourceMessage::CATEGORY_GENERAL,'Buy your next ticket');?><!--"></a>-->
<!--                                    --><?// endif; ?>
<!--                                    --><?php //if($hotNumbersPage !== null) :?>
<!--                                        <form method="post" class="hot-numbers-link hidden-xs" action="--><?//= $hotNumbersPage->pageContentByLanguage->fullUrl; ?><!--">-->
<!--                                            <input type="hidden" name="lottery_id" value="--><?//= $lottery->id; ?><!--">-->
<!--                                            <button type="submit" class="lottery-page-hot-link long-info-button" name="submit">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hot and Cold Numbers'); ?><!--</button>-->
<!--                                        </form>-->
<!--                                    --><?php //endif; ?>
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </section>-->
<!--            </div>-->
<!--            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>-->
<!--        </section>-->
        <section class="row lottery-info-block">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                <span class="h2 hidden-xs" ><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'More_info_about');?> <?=Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);?></span>  <?php // TODO: fix to only one header, not each for mobile and desktop.  ?>
                <table class="compare-table table table-hover lottery-page-collapser collapsible-mobile-menu collapsing-buttons">
                    <thead>
                    <tr class="mobile-collapser" data-collapse-selector="tbody.mobile-collapsible" data-collapse-parent-selector="table">
                        <td class="h2 collapsible-mobile-link" aria-expanded="false">
                            <a href="javascript:;" class="mobile-container">
                                <span class="collapsible-menu-title"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'More_info_about');?> <?=Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);?></span>
                                <span class="collapsible-menu-arrow">
                                        <i class="glyphicon glyphicon-chevron-right"></i>
                                    </span>
                            </a>
                        </td>
                    </tr>
                    </thead>
                    <tbody class="mobile-collapsible">
                    <tr>
                        <td><span class="lotto-page-lotto-options"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Country');?></span></td>
                        <td><img class='shadows-effect border-radius-effect' src="<?= Yii::$app->imageManager->path($lottery->country->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,$lottery->country->name);?>" title="<?=Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name);?>"/></td>
                    </tr>
                    <tr>
                        <td><span class="lotto-page-lotto-options"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Numbers to guess');?></span></td>
                        <td><?=$lottery->mainNumbersToCheck;?> <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'from');?> <?=$lottery->mainNumbers;?><?=(!empty($lottery->mainNumbersDescription)?'<br>'.Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->mainNumbersDescription):"");?></td>
                    </tr>
                    <tr>
                        <td><span class="lotto-page-lotto-options"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Additional Numbers');?></span></td>
                        <td><?=(!empty($lottery->addNumbers)?$lottery->addNumbersToCheck.' '.Yii::t(SourceMessage::CATEGORY_GENERAL,'from').' '.$lottery->addNumbers:Yii::t(SourceMessage::CATEGORY_GENERAL,'No Add. Numbers'));?><?=(!empty($lottery->addNumbersDescription)?'<br>'.Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->addNumbersDescription):"");?></td>
                    </tr>
                    <tr>
                        <td><span class="lotto-page-lotto-options"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Chance to win');?></span></td>
                        <td>1 <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'in').' '.$lottery->chanceToWin ?></td>
                    </tr>
                    <tr>
                        <td><span class="lotto-page-lotto-options"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Next jackpot');?></span></td>
                        <td><span class="counter money is-a-jackpot" <?php if($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>><?=$lottery->jackpot;?></span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= isset($rightJackpotsBlock) ? $rightJackpotsBlock : ''; ?>
        <?= isset($rightBannerBlock) ? $rightBannerBlock : ''; ?>
    </div>
</div>

<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div id="lotto-page-remove" class="col-lg-10 col-md-12 col-sm-12 col-xs-12 table-bordered-top-mobile">
        <span class="h1"><?=Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);?> <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Available agents');?></span>
        <?php if(!empty($lottery->brokerToLotteries)) : ?>
            <table class="compare-table" data-toggle="table" data-pagination="true" data-page-size="<?=Yii::$app->pageData->settings[Setting::COUNT_OF_BROKERS_ON_LOTTERY_PAGE]->value; ?>">
                <thead class="hidden-xs">
                <tr>
                    <th data-field="name"
                        data-align="center"
                        data-sortable="true">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Broker');?>
                    </th>
                    <th data-field="LanguageSupport"
                        data-align="center"
                        data-sortable="false">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Language Support');?>
                    </th>
                    <th data-field="Systematic"
                        data-align="center"
                        data-sortable="false">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic');?>
                    </th>
                    <th data-field="syndicat"
                        data-align="center"
                        data-sortable="true">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Syndicat');?>
                    </th>
                    <th data-field="Year"
                        data-align="center"
                        data-sorter="priceSorter"
                        data-sortable="true">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Price');?>
                    </th>
                    <th data-field="scan"
                        data-align="center"
                        data-sortable="false">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Max Discounts');?>
                    </th>
                    <th data-field="action"
                        data-align="center">
                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Action');?>
                    </th>
                </tr>
                </thead>
                <tbody id="brokers">
                <? foreach ($lottery->brokerToLotteries as $brokerToLottery) { $broker = $brokerToLottery->broker; $i++; ?>
                    <tr>
                        <td class="main-page-brokers-logo">
                            <?= Html::img(Yii::$app->imageManager->path($broker->status->listImage),['class' => 'testedBroker hidden-sm']);; ?>
                            <br class="hidden-xs">
                            <a class="broker_description" href="<?php if(!empty($broker->site)){ echo Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$broker->site); }
                            elseif($broker->hasReviewPage()) {echo $broker->reviewPage->pageContentByLanguage->fullUrl;} else{ echo 'javascript:;';} ; ?>"
                               rel="nofollow" target="blank" data-html="true"
                               data-content="<?= $broker->hasReviewPage() ? $broker->reviewPage->pageContentByLanguage->additionalDescription : ''; ?>" rel="popover" data-placement="right">
                                <img class="broker-image" src='<?= Yii::$app->imageManager->path($broker->image); ?>' alt='<?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?>' />
                            </a>
                            <br class="hidden-xs" />
                            <a class="hidden-xs" href="<?= $broker->hasReviewPage() ? $broker->reviewPage->pageContentByLanguage->fullUrl : 'javascript:;';?>"><?=Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name);?></a>
                        </td>
                        <td class="expanded-line hidden-xs">
                            <? if(isset($broker->languages[Yii::$app->pageData->currentLanguage->id])) : ?>
                                <img src='<?= Yii::$app->imageManager->path($broker->languages[Yii::$app->pageData->currentLanguage->id]->image); ?>' alt="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Supported Language'); ?>" width='40px'/>
                            <?php else :  ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>
                        </td>
                        <td class="expanded-line hidden-xs">
                            <div class="row mobile-contained-row">
                                <?php if(!empty($brokerToLottery->systematics)): ?>
                                    <span class="yes-icon"></span>
                                <?php else : ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="expanded-line hidden-xs">
                            <?php if($brokerToLottery->syndicat) : ?>
                                <span class="yes-icon"></span>
                            <?php else : ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>
                        </td>
                        <td class="expanded-line">
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title mt-5">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Price');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data no-padding-mobile">
                                    <span class="money ticket-price">
                                        <?= $brokerToLottery->price ;?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="expanded-line hidden-xs">
                            <? if( !empty($brokerToLottery->discounts) ){ ?>
                                <span class="yes-icon"></span>
                            <? } else { ?>
                                <span class="no-icon"></span>
                            <? } ?>
                        </td>
                        <td class="expanded-line mt-20-mobile">
                            <?if($broker->hasReviewPage()):?>
                                <a class="button-for-mobile_2 link mobile-single-link" href="<?=$broker->reviewPage->pageContentByLanguage->fullUrl;?>">
                                    <span class="mobile-container">
                                        <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?> <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'agent_review');?>
                                        <span class="double-arrow double-arrow-transparent visible-xs"></span>
                                    </span>
                                </a>
                            <?endif;?>
                            <?if(isset($broker->site)):?>
                                <a class="shadows-effect border-radius-effect button-red mobile-single-link" rel="nofollow" href="<?=Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$brokerToLottery->url);?>" target="_blank">
                                    <span class="mobile-container">
                                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Play at');?> <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?>
                                        <span class="double-arrow visible-xs"></span>
                                    </span>
                                </a>
                            <?endif;?>
                        </td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-brokers-lottery">
                <p><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'no_brokers_lottery_table_text'); // Unfortunately, none of the agents listed at our website offers this lotto online. Still, you can try luck in more than 60 other popular lotteries from around the world at TheLotter.  ?></p>
<!--                <a href="--><?//= isset($buy_ticket_url) && !empty($buy_ticket_url) ? Yii::t(SourceMessage::CATEGORY_GENERAL,$buy_ticket_url) : Yii::t(SourceMessage::CATEGORY_GENERAL,$theLotter->site); ?><!--" class="button-red no-brokers-button">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL,'Try now!'); ?><!--</a>-->
            </div>
        <?php endif; ?>
        <? if($i > Yii::$app->pageData->settings[Setting::COUNT_OF_BROKERS_ON_LOTTERY_PAGE]->value)
        { ?>
            <div class="row-mobile-only">
                    <span class="collapsible-mobile-menu one-line" id="paginationsToggle">
                        <a href="javascript:;" aria-expanded="false" class="pull-right main-page-allResults collapsible-mobile-link">
                            <span class="mobile-container">
                                <span class="collapsible-menu-title"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'View All');?></span>
                                <span class="collapsible-menu-arrow">
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </span>
                            </span>
                        </a>
                    </span>
            </div>
        <? } ?>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="mobile-container visible-xs">
        <div class="h2">
            <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Find out more about'); ?> <?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?>
        </div>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile expandable-mobile-container">
        <?=Yii::$app->pageData->pageContent->content2;?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<?= isset($bottomJackpotsBlock) ? $bottomJackpotsBlock : ''; // css,js for bottom and right results. ?>
<link rel="stylesheet" href="/public/css/bottom-jackpot.css">
<script src="/public/js/bottom-top-jackpots.js"></script>