<?php

use \common\models\records\Page;
use \common\models\records\SourceMessage;
use frontend\helpers\OldHelper;

/* @var \common\models\records\Lottery[] $lotteries */
/* @var \common\models\records\Broker[] $brokers */
/* @var \common\models\records\Page[] $articles */
/* @var \common\models\records\LotteryResult[] $lastResults */

?>

<section class="row" id="main-content">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" id="main-content-on-home-page">
        <div class="mobile-colored-container row">
            <h1 class="h1-of-home-page">

<!--                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'World Lottery Reviews and Agency'); ?>
            </h1>
            <section class="hidden-xs">
                <div id="main-table" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?= Yii::$app->pageData->pageContent->content1; ?>
                    <table id="special-table" class="compare-table" data-toggle="table" data-height="850"
                           data-pagination="true" data-page-size="100">
                        <thead>
                        <tr>
                            <th data-field="name"
                                data-align="center"
                                data-sortable="true"
                                data-sorter="devideTAGSSorter">
<!--                                <span class="hidden-xs">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Lottery'); ?><!--</span>-->
                            </th>
                            <th data-field="country"
                                data-align="center"
                                data-sortable="true"
                                data-sorter="devideTAGSSorter">
<!--                                <span class="hidden-xs">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'country'); ?><!--</span>-->
                            </th>
                            <th data-field="numbers"
                                data-align="center"
                                data-sortable="true"
                                data-sorter="numbersToGuess">
<!--                                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'numbers to guess'); ?>
                            </th>
                            <th data-field="addNumbers"
                                data-align="center"
                                data-sortable="true">
<!--                                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'additional numbers'); ?>
                            </th>
                            <th data-field="jackpot"
                                data-align="center"
                                data-sorter="jackpotSorter"
                                data-sort-name="_jackpot_data"
                                data-sortable="true">
<!--                                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'next jackpots'); ?>
                            </th>
                            <th data-field="nextDraw"
                                data-align="center"
                                data-sorter="timeSorter"
                                data-sortable="true">
<!--                                --><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'next draw'); ?>
                            </th>
                            <th data-field="action"
                                data-align="center">
<!--                                <span class="hidden-xs">--><?//= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Action'); ?><!--</span>-->
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lotteries as $lottery) : ?>
                            <tr>
                                <td order="<?= $lottery->name; ?>">
                                    <?php if ($lottery->hasReviewPage()): ?>
                                    <a href="<?= $lottery->reviewPage->pageContentByLanguage->fullUrl; ?>"
                                       target="blank">
                                        <? endif; ?>
                                        <img alt="<?= $lottery->name; ?>"
                                             src='<?= Yii::$app->imageManager->path($lottery->logoImage); ?>'/>
                                        <? if ($lottery->hasReviewPage()): ?>
                                    </a>
                                <?php endif; ?>
                                    <br class="hidden-sm hidden-xs">
                                    <?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->name); ?>
                                </td>
                                <td>
                                    <img alt="<?= $lottery->country->name; ?>" src='<?= Yii::$app->imageManager->path($lottery->country->image); ?>'/>
                                    <br>
                                    <?= Yii::t(SourceMessage::CATEGORY_COUNTRIES, $lottery->country->name); ?>
                                </td>
                                <td class="remove-for-mobile-xs" order="<?= $lottery->mainNumbers; ?>">
                                    <?= $lottery->mainNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $lottery->mainNumbers; ?>
                                    <?= (!empty($lottery->mainNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->mainNumbersDescription) : ""); ?>
                                </td>
                                <td class="remove-for-mobile-xs">
                                    <?= (!empty($lottery->addNumbers) ? $lottery->addNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $lottery->addNumbers : Yii::t(SourceMessage::CATEGORY_GENERAL, 'No Add. Numbers')); ?>
                                    <span class="hidden-xs">
                                                    <?= (!empty($lottery->addNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->addNumbersDescription) : ""); ?>
                                                    </span>
                                </td>
                                <td data-jackpot="<?= $lottery->jackpot; ?>">
                                    <span class="counter money is-a-jackpot"
                                          <?php if ($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>><?= $lottery->jackpot; ?></span>
                                </td>
                                <td>
                                    <span class="glyphicon glyphicon-time"
                                          aria-hidden="true"></span>
                                    <span class="timer" time="<?= $lottery->nextDraw; ?>"></span>
                                </td>
                                <td>
                                    <?php if ($lottery->hasReviewPage()): ?><a class="button-for-mobile link"
                                                                               href="<?= $lottery->reviewPage->pageContentByLanguage->fullUrl; ?>"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Read Full Review'); ?></a><?php endif; ?>
                                    <?php if ($lottery->hasBuyOnlinePage()): ?><a
                                        class="shadows-effect border-radius-effect button-red"
                                        title="<?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->name); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'is offered by'); ?>: <?= count($lottery->brokerToLotteries); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'brokers'); ?>"
                                        href="<?= $lottery->buyOnlinePage->pageContentByLanguage->fullUrl; ?>"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Compare Ticket Prices'); ?></a><?php endif; ?>
                                </td>
                            </tr>
                            <!--                        --><? // }?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LOTTERIES_TABLE]->pageContentByLanguage->fullUrl; ?>"
                       class="pull-right main-all hidme hidden-xs"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More lotteries'); ?></a>
                </div>
            </section>
            <?= isset($mobileSliderLotteries) ? $mobileSliderLotteries : '' ?>
        </div>
        <div class="clearfix"></div>

        <h2 class="second-header-block"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Tested lottery agents'); ?></h2>
        <section class="row hidden-xs">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 brokers-block">
                <!-- tested agents -->

                <!-- not tested agents -->
                <? $i = 0;
                //echo $page['count_of_brokers'];
                foreach ($brokers as $key => $broker) {
                    $i++; ?>
                    <? if ($broker->isPositive()): ?>
                        <a href="<? if ($broker->hasReviewPage()) {
                            echo $broker->reviewPage->pageContentByLanguage->fullUrl;
                        } else {
                            echo 'javascript:;';
                        } ?>" class="broker-descriptions col-lg-3 col-md-3 col-xs-12 col-sm-4">
                            <div class="main-page-brokers-logo brokers">
                                <img width="100%" alt="<?= $broker->name; ?>"
                                     src='<?= Yii::$app->imageManager->path($broker->image); ?>'/>
                                <?php if ($broker->status->mainPageImage !== null) : ?>
                                    <div style="background-image: url('<?= Yii::$app->imageManager->path($broker->status->mainPageImage); ?>');"
                                         class="recomend hide-on-mobile">
                                    </div>
                                    <div style="background-image: url('<?= Yii::$app->imageManager->path($broker->status->mainPageImage); ?>');"
                                         class="recomend-mobile hide-not-mobile">
                                    </div>
                                <?php endif; ?>
                                <? if ($broker->hasReviewPage()) { ?>
                                    <div class="pop-up row">
                                        <div class="col-xs-8 col-sm-12">
                                            <?= $broker->reviewPage->pageContentByLanguage->additionalDescription; ?>
                                        </div>
                                        <div class="col-xs-4 hidden-sm hidden-md hidden-lg lotteries count">
                                            <center>
                                                <span class="number"><?= count($broker->brokerToLotteries); ?></span><br>
                                                <span class="word"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Lottories'); ?></span>
                                            </center>
                                        </div>
                                    </div>
                                <? } ?>
                            </div>
                        </a>
                    <? endif; ?>
                <? } ?>
            </div>
            <div class="col-xs-12">
                <a href="javascript:;" class="hidden-xs pull-right main-page-allResults"
                   id="lookotherBrokers"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'View All'); ?></a>
            </div>
        </section>
        <?= isset($mobileSliderAgents) ? $mobileSliderAgents : '' ?>
        <section class="row lastResultsSection">
            <div class="col-xs-12 no-padding-mobile">
                <div class="main-header-lastResults">
                    <span><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Last Lottery Results'); ?></span>
                </div>
                <div id="contain" class="hidden-xs last-five-results-block">
                    <table id="not-special-table" data-toggle="table" data-height="2000"
                           class="main-page popularLottories" data-pagination="true"
                           data-page-size="10">
                        <thead id="table_fixed" class="hidden-lg hidden-md hidden-sm hidden-xs">
                        <tr>
                            <th data-field="name" data-align="center" data-width="150">
                            </th>
                            <th data-field="date" data-align="center">
                            </th>
                            <th data-field="jackpot" data-align="left" data-sorter="numberSorter" data-field="name"
                                data-align="center" data-sortable="true">
                                <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'next jackpots'); ?>
                            </th>
                            <th data-field="action"
                                data-align="center">
                            </th>
                        </tr>
                        </thead>
                        <tbody id="slider-for-result-last">
                        <? foreach ($lastResults as $result) { ?>
                            <tr>
                                <td>
                                    <? if ($result->lottery->hasReviewPage()): ?>
                                    <a href="<?= $result->lottery->reviewPage->pageContentByLanguage->fullUrl; ?>">
                                        <? endif; ?>
                                        <img width=''
                                             src="<?= Yii::$app->imageManager->path($result->lottery->logoImage); ?>"
                                             alt="<?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $result->lottery->name); ?>"/>
                                        <? if ($result->lottery->hasReviewPage()): ?>
                                    </a>
                                <? endif; ?>
                                </td>
                                <td>
                                    <span date="<?= $result->getNativeDatetime()->format('d-m-Y'); ?>"><?= OldHelper::formatResultsData($result->getNativeDatetime()) ?></span>
                                </td>
                                <td>
                                    <?= \frontend\widgets\Numbers::widget(['lotteryResult' => $result]); ?>
                                </td>
                                <td>
                                    <? if ($result->lottery->hasReviewPage()): ?><span class="button-red"><a
                                                href="<?= $result->lottery->reviewPage->pageContentByLanguage->fullUrl; ?>"
                                                class="button"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Lottery Info'); ?></a>
                                        </span><? endif; ?>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
                <?= isset($mobileSliderResults) ? $mobileSliderResults : '' ?>
                <a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LAST_RESULTS_TABLE]->pageContentByLanguage->fullUrl; ?>"
                   class="pull-right arrow-button main-page-allResults mobile-single-link">
                    <span class="mobile-container"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'View All'); ?><span
                                class="hidden-xs"> ></span><span class="double-arrow visible-xs"></span></span>
                </a>
            </div>
        </section>
        <div class="main-header-lastNews">
            <span><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Last News'); ?></span>
        </div>
        <div class="row last-news-block">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs">
                <? foreach ($articles as $article) { ?>
                    <div class="col-lg-3 col-xs-12 col-md-3 col-sm-6">
                        <div class="row items">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-4">
                                <center><img
                                            src="<?= Yii::$app->imageManager->path($article->pageContentByLanguage->image); ?>"
                                            alt="<?= $article->pageContentByLanguage->title; ?>" width="100%"/></center>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-8">
                                <div id="side189">
                                    <center>
                                        <a href="<?= $article->pageContentByLanguage->fullUrl; ?>">
                                            <h3 style=""><?= $article->pageContentByLanguage->title; ?></h3>
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
            <?php $lastNew = reset($articles); ?>
            <div class="mobile-last-news hidden-sm hidden-md hidden-lg">
                <div class="news-image">
                    <img width="100%"
                         src="<?= Yii::$app->imageManager->path($lastNew->pageContentByLanguage->image); ?>"
                         alt="<?= $lastNew->pageContentByLanguage->title; ?>">
                </div>
                <div class="collapsible-mobile-menu expand-news">
                    <a href="javascript:;" class="collapsible-mobile-link" data-toggle="collapse"
                       data-target="#lastNewsMobileInfo" aria-expanded="false">
                        <span class="mobile-container">
                            <span class="collapsible-menu-title"><?= $lastNew->pageContentByLanguage->title; ?></span>
                            <span class="collapsible-menu-arrow">
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </span>
                        </span>
                    </a>
                    <div id="lastNewsMobileInfo" class="menu-container collapse">
                        <div class="mobile-container">
                            <div><?= $lastNew->pageContentByLanguage->additionalDescription; ?></div>
                            <a class="news-more-link" href="<?= $lastNew->pageContentByLanguage->fullUrl; ?>">
                                <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More'); ?>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 no-padding-mobile">
                <a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_ARTICLES_LIST]->pageContentByLanguage->fullUrl ?>"
                   class="pull-right arrow-button main-page-allNews more-news-HomePage mobile-single-link">
                <span class="mobile-container">
                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More news'); ?> <span class="hidden-xs">></span>
                    <span class="double-arrow visible-xs"></span>
                </span>
                </a>
            </div>
        </div>
</section>

<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <?= Yii::$app->pageData->pageContent->content2; ?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>