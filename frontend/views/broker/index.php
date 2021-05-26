<?php
use common\models\records\Page;
use common\models\records\Broker;
use \common\models\records\SourceMessage;
use frontend\assets\AppAsset;

/* @var Broker $broker */
?>

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                <div class="broker-trade-mark">
                    <?php if (!$broker->isPositive()): ?>
                        <img width="220px" style="margin-left: 10px;" alt="<?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?>"
                             src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                        <br>
                        <span style="display: inline-block; margin-left: 10px;"><?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?></span>
                        <div class="left-broker-label left-broker">
                            <div class="bg-left-broker hidden-xs" style="background-image: url(<?= Yii::$app->imageManager->path($broker->status->brokerPageImage); ?>);"></div>
                        </div>
                        <div class="mobile-label hidden-sm hidden-md hidden-lg">
                            <div class="line-mobile hidden-sm hidden-md hidden-lg grey-line"><?= Yii::t(SourceMessage::CATEGORY_BROKER_STATUSES, $broker->status->name); ?></div>
                        </div>

                    <?php elseif ($broker->isPositive()): ?>
                        <div class="left-broker-label left-broker-green">
                            <div class="bg-left-broker-green hidden-xs" style="background-image: url(<?= Yii::$app->imageManager->path($broker->status->brokerPageImage); ?>);"></div>
                        </div>
                        <div class="right-broker">
                            <?php if (!empty($broker->site)): ?>
                                <a href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS, $broker->site); ?>" target="blank" rel="nofollow">
                                    <img width="220px" alt="<?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?>" src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                                </a>
                            <?php else: ?>
                                <img width="220px" alt="<?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?>" src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                            <?php endif; ?>

                            <div class="mobile-label hidden-sm hidden-md hidden-lg">
                                <div class="line-mobile hidden-sm hidden-md hidden-lg green-line"><?= Yii::t(SourceMessage::CATEGORY_BROKER_STATUSES, $broker->status->name); ?></div>
                            </div>
                            <div class="inner-votes">
                                <div class="votes-total">
                                    <div class="votes-profile">

                                    </div>
                                    <div class="votes-right">
                                        <div class="votes-stars" data-marks="<?= ($broker->marks != 0 && $broker->summaryMarks != 0) ? $broker->summaryMarks / $broker->marks : 0; ?>">
                                            <?php $oneStarPixelsMobile = 18;
                                            $mobileWidth = ($broker->marks != 0 && $broker->summaryMarks != 0) ? $oneStarPixelsMobile * $broker->summaryMarks / $broker->marks : 0; ?>
                                            <span class="stars-mobile" style="width: <?= (int)$mobileWidth; ?>px;"></span>
                                            <span class="stars"></span>
                                        </div>
                                        <div class="votes-count">
                                            <p>
                                                <span class="votes-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Total votes'); ?></span>
                                                <span id="number-of-votes"><?= $broker->marks; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="votes-button" data-toggle="modal" data-target="#voting-modal">
                                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Please rate'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <article class="mobile-container">
                    <?= Yii::$app->pageData->pageContent->content1; ?>
                </article>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                <div class="header-inside " style="<?= empty($compared) ? "width:100%" : ""; ?>">
                    <center class="mobile-container">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More Info About'); ?>
                        <a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_BROKERS_TABLE]->pageContentByLanguage->fullUrl; ?>"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Lottery Agent'); ?></a>
                    </center>
                </div>
                <table class="table compare-broker-table compare-table info-table brokers-table"
                       style="<?= empty($compared) ? "width:100%" : ""; ?>">
                    <thead>
                    <tr>
                        <td style="padding: 0" width="<?= empty($compared) ? "20%" : "10%"; ?>"></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="hidden-xs">
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Brand Name'); ?></td>

                        <td name="broker_name1" broker="1">
                            <?php if ($broker->isPositive() && $broker->hasReviewPage() && !empty($broker->site)) : ?>
                                <a class="broker_description" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS, $broker->site) ?>"
                                   rel="nofollow" target="blank" data-html="true"
                                   data-content="<?= $broker->reviewPage->pageContentByLanguage->additionalDescription ?>" rel="popover"
                                   data-placement="right">
                                    <img alt="<?= $broker->name; ?>"
                                         src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                                </a>
                            <?php else: ?>
                                <img alt="<?= $broker->name; ?>"
                                     src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="expanded-line pt-10-mobile">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Avaliable Lottories'); ?></td>
                        <td class="expanded-data bold-expanded-data" name="lottories1" broker="1">
                            <?php if (!empty($broker->brokerToLotteries)): ?><?= count($broker->brokerToLotteries); ?>
                            <?php
                                $lotteriesList = '';
                                foreach ($broker->brokerToLotteries as $brokerToLottery) {
                                    $link = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $brokerToLottery->url);
                                    $image = Yii::$app->imageManager->path($brokerToLottery->lottery->logoImage);
                                    $lotteryName = Yii::t(SourceMessage::CATEGORY_LOTTERIES,$brokerToLottery->lottery->name);
                                    $lotteriesList .= "<a href='{$link}' target='blank'><img src='{$image}' alt='{$lotteryName} - {$broker->name}' width='110px'/></a>";
                                }
                            ?>
                                <span class="hidden-xs">
                                        <br>
                                    <a class='popover-toggle' href='#' data-html='true'
                                               data-content="<?= $lotteriesList; ?>"
                                               rel='popover' data-placement='bottom' data-trigger='hover' data-original-title
                                               title="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'lottories'); ?>"><img src='/public/img/lotto.png'/>
                                    </a>
                                    </span>
                            <?php else : ?>
                                <span class="no-icon"></span>
                                <span class="no-lotteries-after-x-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'broker_no_lotteries_text'); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'welcome bonus list'); ?></td>
                        <td class="expanded-data" name="bonuses1" broker="1">
                            <?php if (!empty($broker->bonuses)) : ?>
                                <?php foreach ($broker->bonuses as $bonus) : ?>
                                    <p><?= Yii::t(SourceMessage::CATEGORY_BONUSES, $bonus->name); ?></p>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Systematic'); ?></td>
                        <td class="expanded-data" name="systematic1" broker="1">
                            <?= $broker->systematic ? "<span class='yes-icon'></span>" : "<span class='no-icon'></span>" ?>                            
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Scan ticket'); ?></td>
                        <td class="expanded-data" name="scan_ticket1" broker="1">                            
                            <?= $broker->scanTicket ? "<span class='yes-icon'></span>" : "<span class='no-icon'></span>" ?>                            
                        </td>                        
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Syndicat'); ?></td>
                        <td class="expanded-data" name="syndicat1" broker="1">
                            <?= $broker->syndicat ? "<span class='yes-icon'></span>" : "<span class='no-icon'></span>" ?>                            
                        </td>                        
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Monthly visits'); ?></td>
                        <td class="expanded-data bold-expanded-data" name="clicks1" broker="1">                            
                            <?= number_format($broker->clicks, 0, ',', ' '); ?>                            
                        </td>                        
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Languages'); ?></td>
                        <td class="expanded-data alone-expanded-data" name="languages1" broker="1">
                            <div class="hidden-xs">                               
                                    <?php foreach ($broker->languages as $language) { ?><img
                                        class='shadows-effect border-radius-effect compare-brokers-items' width='60px'
                                        class='country-name' alt='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES, $language->name); ?>'
                                        title='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES, $language->name); ?>'
                                        src='<?= Yii::$app->imageManager->path($language->image); ?>' /><?php } ?>
                                
                            </div>
                            <?php /* Mobile */ if(count($broker->languages) < 4) : ?>
                                <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach($broker->languages as $language) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL, $language->name);?>" width="60px"/>
                                    <?php } ?>
                                </div>
                            <?php else: ?>
                                <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach(array_slice($broker->languages,0,3) as $language) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL, $language->name);?>" width="60px"/>
                                    <?php } ?>
                                    <div id="languages-collapse-<?= $broker->id; ?>" class="collapse">
                                        <?php foreach(array_slice($broker->languages,3) as $language) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL, $language->name);?>" width="60px"/>
                                        <?php } ?>
                                    </div>
                                    <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#languages-collapse-<?= $broker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Hide'); ?></span></a>
                                </div>
                            <?php endif; ?>
                        </td>                       
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Online since'); ?></td>
                        <td class="expanded-data bold-expanded-data" name="year1" broker="1">
                            <?php if (!empty($broker->year)): ?>
                                <?= $broker->year; ?>
                            <?php else : ?>
                                <span class='no-icon'></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Mail'); ?></td>
                        <td class="expanded-data" name="email1" broker="1">
                            <?php if(!empty($broker->brokerEmails)) : ?>
                                <?php foreach ($broker->brokerEmails as $brokerEmail) : ?>
                                    <?= $brokerEmail->translatedName; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Deposit Methods'); ?></td>
                        <td class="expanded-data alone-expanded-data" name="paymentMethods1" broker="1">
                            <div class="hidden-xs">
                                <?php if (!empty($broker->paymentMethods)): ?>
                                    <?php foreach ($broker->paymentMethods as $paymentMethod) { ?><img
                                        class='shadows-effect compare-brokers-items' width='60px'
                                        alt='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS, $paymentMethod->name); ?>' title='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS, $paymentMethod->name); ?>'
                                        src='<?= Yii::$app->imageManager->path($paymentMethod->image); ?>' /><?php } ?>
                                <?php else: ?>
                                    <span class='no-icon'></span>
                                <?php endif; ?>
                            </div>
                            <?php /* Mobile */ if(count($broker->paymentMethods) < 4) : ?>
                                <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach($broker->paymentMethods as $paymentMethod) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS, $paymentMethod->name);?>"/>
                                    <?php } ?>
                                </div>
                            <?php else: ?>
                                <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach(array_slice($broker->paymentMethods,0,3) as $paymentMethod) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS, $paymentMethod->name);?>"/>
                                    <?php } ?>
                                    <div id="payments-collapse-<?= $broker->id; ?>" class="collapse">
                                        <?php foreach(array_slice($broker->paymentMethods,3) as $paymentMethod) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS, $paymentMethod->name);?>"/>
                                        <?php } ?>
                                    </div>
                                    <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#payments-collapse-<?= $broker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Hide'); ?></span></a>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line">
                        <td class="mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Online Chat'); ?></td>
                        <td class="expanded-data" name="chat1" broker="1">
                            <?= $broker->chat ? "<span class='yes-icon'></span>" : "<span class='no-icon'></span>" ?>
                        </td>
                    </tr>
                    <tr class="clearfix hidden-sm hidden-md hidden-lg"></tr><tr class="clearfix hidden-sm hidden-md hidden-lg"></tr>
                    <tr class="expanded-line out-55-line">
                        <td class="mobile-title hidden-xs"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Action'); ?></td>
                        <td class="expanded-data alone-expanded-data" name="action1" broker="1">
                            <br class="hidden-xs">
                            <?php if ($broker->isPositive() && !empty($broker->site)) : ?>
                                <a class="mobile-single-link link-in-compare-table button-red"  target="_blank" rel="nofollow" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS, $broker->site); ?>">
                                    <span class="mobile-container">
                                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Site'); ?>
                                        <span class="double-arrow"></span>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <!-- start of raiting circles -->
                <?php if ($broker->isPositive()): ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 circles-wrapper">
                        <div class="left-circle row hidden-sm hidden-md hidden-lg">
                            <div>
                                <span class="h2"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Editor Rating'); ?></span>
                            </div>
                            <div class="circle-mobile">
                                <div class="inner-circle">
                                    <span><?= addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL, 'Rate')); ?></span>
                                    <span class="total-score">
                                        <?= ($broker->security + $broker->support + $broker->gameplay + $broker->promotions + $broker->withdrawals + $broker->usability + $broker->gameSelection + $broker->discounts) / 8;
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="collapsible-mobile-menu one-line collapsing-circles hidden-sm hidden-md hidden-lg">
                                <a href="javascript:;" class="collapsible-mobile-link" data-toggle="collapse" data-target="#collapsingCircles" aria-expanded="false">
                                <span class="mobile-container">
                                    <span class="collapsible-menu-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'More info'); ?></span>
                                    <span class="collapsible-menu-arrow">
                                        <i class="glyphicon glyphicon-chevron-right"></i>
                                    </span>
                                </span>
                                </a>
                                <div id="collapsingCircles" class="menu-container collapse broker-table">
                                    <div class="mobile-container">
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Security'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->security;; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Support'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->support; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Gameplay'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->gameplay; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Promotions'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->promotions; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Widthdrawals'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->withdrawals; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Usability'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->usability; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6 mobile-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Game Selection'); ?></div>
                                            <div class="col-xs-6 expanded-data"><?= $broker->gameSelection; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- big circle -->
                        <div class="left-circle row hidden-xs">
                            <div class="arrow_box">
                                <span><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Editor Rating'); ?></span>
                            </div>
                            <div class="circle-score-big">
                                <div class="inner-circle">
                                    <span><?= addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL, 'Rate')); ?></span>
                                    <span class="total-score">
                                        <?= ($broker->security + $broker->support + $broker->gameplay + $broker->promotions + $broker->withdrawals + $broker->usability + $broker->gameSelection + $broker->discounts) / 8;
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- small circles -->
                        <div class="right-circles hidden-xs">

                            <div class="multiply-scores row">
                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Security'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?=
                                                $broker->security;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Support'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?= $broker->support; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Gameplay'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?= $broker->gameplay; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Promotions'); ?></span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?= $broker->promotions; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="multiply-scores row">
                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Widthdrawals'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?=
                                                $broker->withdrawals;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Usability'); ?></span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?= $broker->usability; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Game Selection'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?=
                                                $broker->gameSelection;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="right-small-circle circle-extra-small">
                                    <div class="arrow_box_small">
                                        <span>
                                            <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Discounts'); ?>
                                        </span>
                                    </div>
                                    <div class="circle-score-small">
                                        <div class="inner-circle">
                                            <span class="total-score">
                                                <?=
                                                $broker->discounts;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>

    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 banners-and-results-block">

        <?php /* Order issues. */ if(isset($lotteryAgentWidget) && !$broker->isPositive()) : ?>
            <?= $lotteryAgentWidget; ?>
        <?php endif; ?>
        <?= isset($rightBannerBlock) ? $rightBannerBlock : ''; ?>
        <?php if($broker->isPositive() && isset($cryptoBannerBlock)) : ?>
            <?= $cryptoBannerBlock; ?>
        <?php endif; ?>
        <?= (isset($lotteryAgentWidget) && $broker->isPositive()) ? $lotteryAgentWidget : ''; ?>
    </div>
</div>
<?php if (!empty($broker->brokerToLotteries)): ?>
    <section class="row">
        <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        <div id="broker-counter" class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
            <span class="h1"><?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?> <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Available lotteries'); ?></span>
            <table class="compare-table table-bordered-top-mobile multiple-lines-thead-tablet" data-toggle="table" data-sort-name="jackpot" data-sort-order="desc"
                   data-pagination="true" data-page-size="10" data-height="150" data-width="12.5%">
                <thead>
                <tr>
                    <th data-field="name"
                        data-align="center"
                        data-sortable="true">
                        <span class="hidden-xs"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Lottery'); ?></span>
                    </th>
                    <th class="mobile-jackpot hidden-sm hidden-md hidden-lg" ></th>
                    <th class="mobile-field hidden-sm hidden-md hidden-lg" ></th>
                    <th class="mobile-field hidden-sm hidden-md hidden-lg" ></th>
                    <th data-field="country"
                        data-align="center"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Country'); ?>
                    </th>
                    <th data-field="numberstogues"
                        data-align="center"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'numbers to guess'); ?>
                    </th>
                    <th data-field="addNumbers"
                        data-align="center"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'additional numbers'); ?>
                    </th>
                    <th data-field="overall_chance"
                        data-align="center"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Overall Chance'); ?>
                    </th>
                    <th data-field="price"
                        data-align="center"
                        data-sorter="priceSorter"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Price on line'); ?>
                    </th>
                    <th data-field="jackpot"
                        data-align="center"
                        data-sorter="jackpotSorter"
                        data-sort-name="_jackpot_data"
                        data-sortable="true">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Next jackpot'); ?>
                    </th>
                    <th data-field="action"
                        data-align="center">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Action'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($broker->brokerToLotteries as $brokerToLottery) {
                    $lottery = $brokerToLottery->lottery;
                    if($broker->isPositive()){
                        $link = Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $brokerToLottery->url);
                    } elseif($lottery->hasBuyOnlinePage()){
                        $link = $lottery->buyOnlinePage->pageContentByLanguage->fullUrl;
                    } else {
                        $link = 'javascript:;';
                    }
                ?>
                        <tr class="lottery-table-item">
                            <td class="lottery-table-logo" order="<?= $lottery->name; ?>">
                                <center>
                                    <a class="link"
                                       href="<?= $link; ?>"
                                       rel="nofollow" target="_blank">
                                        <img alt="<?= $lottery->name; ?>"
                                             src='<?= Yii::$app->imageManager->path($lottery->logoImage); ?>'/>
                                    </a>
                                    <br class="hidden-xs">
                                    <?php if ($lottery->hasReviewPage()) { ?>
                                        <a class="link hidden-xs"
                                           href="<?= $lottery->reviewPage->pageContentByLanguage->fullUrl; ?>"><?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->name); ?></a>
                                    <?php } ?>
                                </center>
                            </td>
                            <td class="lottery-table-jackpot hidden-sm hidden-md hidden-lg" data-jackpot="<?=$lottery->jackpot;?>">
                                <span class="jackpot-icon"></span>
                                <span class="counter money is-a-jackpot"
                                      <?php if($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>>
                                    <?=$lottery->jackpot;?>
                                </span>
                            </td>
                            <td class="lottery-table-buy-button col-xs-4 hidden-sm hidden-md hidden-lg"><a class="buy-button" rel="nofollow" href="<?= $link; ?>"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'play_now_mobile'); ?></a></td>
                            <td class="lottery-table-next-draw col-xs-4 hidden-sm hidden-md hidden-lg">
                                <div class="money"><?= $brokerToLottery->price; ?></div>
                            </td>
                            <td class="lottery-table-country mobile-collapsible hidden-xs">
                                <img alt="<?=$lottery->country->name;?>" src='<?= Yii::$app->imageManager->path($lottery->country->image); ?>' />
                                <center class="country-name hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_COUNTRIES, $lottery->country->name);?></center>
                            </td>
                            <td class="lottery-table-guess mobile-collapsible hidden-xs" order="<?= $lottery->mainNumbers; ?>">
                                <?=$lottery->mainNumbersToCheck.' '.Yii::t(SourceMessage::CATEGORY_GENERAL, 'from').' '.$lottery->mainNumbers;?>
                                <?=(($lottery->mainNumbersDescription)?'<br>'.Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->mainNumbersDescription):"");?>
                            </td>
                            <td class="lottery-table-numbers mobile-collapsible">
                                <?=(($lottery->addNumbers)?$lottery->addNumbersToCheck.' '.Yii::t(SourceMessage::CATEGORY_GENERAL, 'from').' '.$lottery->addNumbers:Yii::t(SourceMessage::CATEGORY_GENERAL, 'No Add. Numbers'));?>
                                <?=(($lottery->addNumbersDescription)?'<br>'.Yii::t(SourceMessage::CATEGORY_GENERAL, $lottery->addNumbersDescription):"");?>
                            </td>
                            <td class="mobile-collapsible">
                                1 <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'in') . ' ' . $lottery->overallChance; ?>
                            </td>
                            <td class="money ticket-price hidden-xs">
                                <?= $brokerToLottery->price; ?>
                            </td>
                            <td class="money is-a-jackpot hidden-xs"
                                <?php if($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>"
                                data-jackpot="<?= $lottery->jackpot; ?>">
                                <?= $lottery->jackpot; ?>
                            </td>
                            <td class="lottery-table-buttons">
                                <?php if($lottery->hasReviewPage()):?>
                                    <a class="button-for-mobile_2 link mobile-single-link" href="<?=$lottery->reviewPage->pageContentByLanguage->fullUrl;?>">
                                        <span class="mobile-container">
                                            <?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->name); ?> <?=Yii::t(SourceMessage::CATEGORY_GENERAL, 'review_lottery_in_table');?>
                                            <span class="double-arrow double-arrow-transparent visible-xs"></span>
                                        </span>
                                    </a>
                                <?php endif;?>
                                <a class="button-red hidden-xs" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK, $brokerToLottery->url); ?>" rel="nofollow"
                                   target="_blank"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'play_lottery_in_table'); ?> <?= Yii::t(SourceMessage::CATEGORY_LOTTERIES, $lottery->name); ?></a>
                            </td>
                        </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php
            if (count($broker->brokerToLotteries) > 10) { ?>
                <div class="row-mobile-only">
                    <span class="pull-right collapsible-mobile-menu one-line main-page-allResults" id="paginationsToggle">
                        <a href="javascript:;" class="collapsible-mobile-link" data-toggle="collapse" aria-expanded="false">
                            <span class="mobile-container">
                                <span class="collapsible-menu-title"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'View All'); ?></span>
                                <span class="collapsible-menu-arrow">
                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                </span>
                            </span>
                        </a>
                    </span>
                </div>
                <?php
            } ?>
        </div>
        <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    </section>

    <?php if (Yii::$app->pageData->pageContent->bottomBanner !== null): ?>
        <section class="row banner-under-table">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <a href="<?= Yii::$app->pageData->pageContent->bottomBanner->link; ?>" rel="nofollow" target="_blank"><img
                    src="<?= Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->bottomBanner->image); ?>" width="100%">
                </a>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
    <?php  endif; ?>
<?php endif; ?>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile expandable-mobile-container">
        <?= Yii::$app->pageData->pageContent->content2; ?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<?php if ($broker->isPositive() && $broker->disableIframe != 1): ?>
    <iframe src="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS, $broker->site); ?>" class="hidden-xs hidden-sm hidden-md" width="100%" height="400px">
    </iframe>
<?php endif; ?>
<div id="voting-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Please rate'); ?> <span class="blue-text"><?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?></span>
                </h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                            <label class="hidden-xs" for="voter-name"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Your Name'); ?> <span class="red-text">*</span></label>
                            <input id="voter-name" name="name" type="text" placeholder="<?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Your Name'); ?>">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group">
                            <label class="hidden-xs" for="voter-email"><?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Your Email'); ?> <span class="red-text">*</span></label>
                            <input id="voter-email" name="email" type="text" placeholder="<?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Your Email'); ?>">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 form-group rating-container">
                            <label class="centering rating-label" for="">
                                <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Score'); ?> <span class="blue-text"><?= Yii::t(SourceMessage::CATEGORY_BROKERS, $broker->name); ?></span>
                                <span class="red-text">*</span></label>
                            <div class="rating">
                                <span>
                                    <input type="radio" name="rating" id="str5" value="5"><label for="str5"></label>
                                </span>
                                <span>
                                    <input type="radio" name="rating" id="str4" value="4"><label for="str4"></label>
                                </span>
                                <span>
                                    <input type="radio" name="rating" id="str3" value="3"><label for="str3"></label>
                                </span>
                                <span><input type="radio" name="rating" id="str2" value="2"><label
                                        for="str2"></label></span>
                                <span><input type="radio" name="rating" id="str1" value="1"><label
                                        for="str1"></label></span>
                            </div>
                        </div>
                        <input type="hidden" name="broker_id" id="broker_ids" value="<?= $broker->id; ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="vote-buttons-position">
                    <button type="button" class="vote-close" data-dismiss="modal">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Close'); ?>
                    </button>
                    <button id="send-vote" type="button" class="vote-rate">
                        <?= Yii::t(SourceMessage::CATEGORY_GENERAL, 'Send'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJsFile('/public/js/circle-progress.js',['depends' => AppAsset::class]); ?>
<?php $this->registerJsFile('/public/js/agent-page.js',['depends' => AppAsset::class]); ?>
