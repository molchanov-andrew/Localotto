<?php

use common\models\records\Lottery;
use common\models\records\Setting;
use \common\models\records\SourceMessage;
use \common\models\records\Page;

/* @var Lottery[] $lotteries */
?>
<?php $firstLottery = reset($lotteries); ?>

<section class="half-round-container hidden-sm hidden-md hidden-lg">
    <div class="round">
        <div id="lotteryCarousel" class="carousel tappable-carousel carousel-fade slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($lotteries as $index => $lottery) : ?>
                    <li data-target="#lotteryCarousel" data-slide-to="<?= $index; ?>"
                        class="<?php if ($firstLottery->id == $lottery->id) { ?>active<?php } ?>"></li>
                <?php endforeach; ?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php
                foreach ($lotteries as $index => $lottery) : ?>
                    <div class="item <?php if ($firstLottery->id == $lottery->id) { ?>active<?php } ?>"
                         data-country-image="<?= Yii::$app->imageManager->path($lottery->country->image); ?>"
                         data-country-alt="<?= $lottery->country->name; ?>"
                         data-numbers-guess="<?= $lottery->mainNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $lottery->mainNumbers; ?>
                                        <?= (!empty($lottery->mainNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_GENERAL, $lottery->mainNumbersDescription) : ""); ?>"
                         data-additional-numbers="<?= (!empty($lottery->addNumbers) ? $lottery->addNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $lottery->addNumbers : Yii::t(SourceMessage::CATEGORY_GENERAL, 'No Add. Numbers')); ?><span>
                                        <?= (!empty($lottery->addNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_GENERAL, $lottery->addNumbersDescription) : ""); ?></span>"
                         data-review="<?= $lottery->hasReviewPage() ? $lottery->reviewPage->pageContentByLanguage->fullUrl : 'javascript:;'; ?>"
                         data-buy-link="<?= $lottery->hasBuyOnlinePage() ? $lottery->buyOnlinePage->pageContentByLanguage->fullUrl : 'javascript:;'; ?>"
                    >
                        <div class="carousel-caption">
                            <div class="lottery-logo">
                                <a href="<?= $lottery->hasReviewPage() ? $lottery->reviewPage->pageContentByLanguage->fullUrl : 'javascript:;' ?>">
                                    <img src="<?= Yii::$app->imageManager->path($lottery->logoImage); ?>"
                                         alt="<?= $lottery->name; ?>">
                                </a>
                            </div>
                            <div class="lottery-jackpot">
                                <span class="counter money is-a-jackpot"
                                      <?php if ($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>><?= $lottery->jackpot; ?></span>
                            </div>
                            <div class="lottery-next-draw">
                                <span class="timer-icon"></span>
                                <span class="timer" time="<?= $lottery->nextDraw; ?>"></span>
                            </div>
                            <?php if (isset($lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value])): ?>
                                <a href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $lottery->brokerToLotteries[Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value]->url); ?>"
                                   class="buy-now-button"
                                   rel="nofollow"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Buy now'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<div class="collapsible-mobile-menu one-line expand-lottery hidden-sm hidden-md hidden-lg">
    <a href="javascript:;" class="collapsible-mobile-link" data-toggle="collapse" data-target="#homeLotterySliderInfo"
       aria-expanded="false">
        <span class="mobile-container">
            <span class="collapsible-menu-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More info'); ?></span>
            <span class="collapsible-menu-arrow">
                <i class="glyphicon glyphicon-chevron-right"></i>
            </span>
        </span>
    </a>
    <div id="homeLotterySliderInfo" class="menu-container collapse">
        <div class="mobile-container">
            <div class="row">
                <div class="col-xs-6 mobile-title">
                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'country'); ?>
                </div>
                <div class="col-xs-6 expand-lottery-country expanded-data">
                    <img src="<?= Yii::$app->imageManager->path($firstLottery->country->image); ?>"
                         alt="<?= $firstLottery->country->name; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 mobile-title">
                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'numbers to guess'); ?>
                </div>
                <div class="col-xs-6 expand-lottery-guess expanded-data">
                    <?= $firstLottery->mainNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $firstLottery->mainNumbers; ?>
                    <?= (($firstLottery->mainNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_GENERAL, $firstLottery->mainNumbersDescription) : ""); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 mobile-title">
                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'additional numbers'); ?>
                </div>
                <div class="col-xs-6 expand-lottery-numbers expanded-data">
                    <?= (($firstLottery->addNumbers) ? $firstLottery->addNumbersToCheck . ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, 'from') . ' ' . $firstLottery->addNumbers : Yii::t(SourceMessage::CATEGORY_GENERAL, 'No Add. Numbers')); ?>
                    <span><?= (($firstLottery->addNumbersDescription) ? '<br>' . Yii::t(SourceMessage::CATEGORY_GENERAL, $firstLottery->addNumbersDescription) : ""); ?></span>
                </div>
            </div>
        </div>
        <a class="mobile-single-link expand-lottery-review" href="<?php if ($firstLottery->reviewPage) {echo $firstLottery->reviewPage->pageContentByLanguage->fullUrl;} ?>">
            <span class="mobile-container">
                <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Read Full Review'); ?>
                <span class="double-arrow double-arrow-transparent"></span>
            </span>
        </a>

        <a class="mobile-single-link expand-lottery-buy-online" href="<?= (isset($firstLottery->buyOnlinePage)) ? $firstLottery->buyOnlinePage->pageContentByLanguage->fullUrl : ''; ?>">
            <span class="mobile-container">
                <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Compare Ticket Prices'); ?>
                <span class="double-arrow double-arrow-transparent"></span>
            </span>
        </a>
    </div>
    <div class="clearfix"></div>
</div>
<a class="mobile-single-link lotteries-page hidden-sm hidden-md hidden-lg"
   href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LOTTERIES_TABLE]->pageContentByLanguage->fullUrl; ?>">
    <span class="mobile-container">
        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More lotteries'); ?>
        <span class="double-arrow"></span>
    </span>
</a>