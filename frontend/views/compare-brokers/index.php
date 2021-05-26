<?php
use \common\models\records\SourceMessage;
use frontend\assets\AppAsset;
use \common\models\records\Broker;

/* @var Broker[] $brokers */
/* @var Broker $leftBroker */
/* @var Broker $rightBroker */
?>

<?php $shown = 2; // shown languages or paymnents for mobile ?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= Yii::$app->pageData->pageContent->content1; ?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section id="compareBrokers" class="row">
            <div class="col-lg-1 col-md-1 hidden-xs hidden-sm"></div>
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 no-padding-mobile">
                <table class="compare-broker-table compare-table info-table table">
                    <thead class="visible-thead-as-block-mobile">
                    <tr>
                        <td class="hidden-xs" width="10%"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Brokers for Compare'); ?></td>
                        <td width="45%" class="compare-broker-select" style="text-align:center;">
                            <select broker-number="1" class="selectpicker" data-live-search="true">
                                <option disabled selected><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'View All Brokers'); ?></option>
                                <?php foreach ($brokers as $broker) { ?>
                                    <option
                                        <?php if ($leftBroker->id == $broker->id){ ?>selected="selected" <?php } ?>
                                        value="<?= $broker->id; ?>">
                                        <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                        <td class="compare-broker-select bordered-select <?php if(!isset($rightBroker)) { ?>basic-value<?php } ?>" width="45%">
                            <select id="secondColumnCompare" broker-number="2" class="selectpicker" data-live-search="true" onchange="$(this)">
                                <option disabled selected><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'View All Brokers'); ?></option>
                                <?php foreach ($brokers as $broker) { ?>
                                    <option
                                        <?php if (isset($rightBroker) && $rightBroker->id == $broker->id){ ?>selected="selected" <?php } ?>
                                        value="<?= $broker->id; ?>">
                                        <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    </thead>
                    <tbody class="mobile-container">
                    <tr class="compare-brand-names">
                        <td class="hidden-xs"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Brand Name'); ?></td>
                        <td name="broker_name1" broker="1">
                                <span class="hidden-xs">
                                    <?php if (!empty($leftBroker->site) && $leftBroker->isPositive() && $leftBroker->hasReviewPage()) : ?>
                                        <a class="broker_description" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$leftBroker->site) ?>"
                                           rel="nofollow" target="blank" data-html="true"
                                           data-content="<?= $leftBroker->reviewPage->pageContentByLanguage->additionalDescription; ?>" data-placement="right">
                                            <img alt="<?= $leftBroker->name; ?>"
                                                 src="<?= Yii::$app->imageManager->path($leftBroker->image); ?>">
                                        </a>
                                    <?php else: ?>
                                        <img alt="<?= $leftBroker->name; ?>"
                                             src="<?= Yii::$app->imageManager->path($leftBroker->image); ?>">
                                    <?php endif; ?>
                                </span>
                            <span class="hidden-sm hidden-md hidden-lg "><?= $leftBroker->name; ?></span>
                        </td>
                        <td name="broker_name2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <span class="hidden-xs">
                                    <?php if (!empty($rightBroker->site) && $rightBroker->isPositive() && $rightBroker->hasReviewPage()) : ?>
                                        <a class="broker_description" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$rightBroker->site) ?>"
                                           rel="nofollow" target="blank" data-html="true"
                                           data-content="<?= $rightBroker->reviewPage->pageContentByLanguage->additionalDescription; ?>"
                                           rel="popover" data-placement="right">
                                            <img alt="<?= $rightBroker->name; ?>"
                                                 src="<?= Yii::$app->imageManager->path($rightBroker->image); ?>">
                                        </a>
                                    <?php else: ?>
                                        <img alt="<?= $rightBroker->name; ?>"
                                             src="<?= Yii::$app->imageManager->path($rightBroker->image); ?>">
                                    <?php endif; ?>
                                </span>
                                <span class="hidden-sm hidden-md hidden-lg"><?= $rightBroker->name; ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Avaliable Lottories'); ?></td>
                        <td name="lottories1" broker="1">
                            <?php if (!empty($leftBroker->brokerToLotteries)) { ?>
                                <?= count($leftBroker->brokerToLotteries); ?>
                                <br class="hidden-xs">
                                <a class='popover-toggle hidden-xs' href='#' data-html='true'
                                   data-content="<?php foreach ($leftBroker->brokerToLotteries as $brokerToLottery) { $lottery = $brokerToLottery->lottery; ?>
                                                        <img src='<?= Yii::$app->imageManager->path($lottery->logoImage) ?>' alt='<?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?> - <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$leftBroker->name); ?>' width='110px'/>
                                                    <?php } ?>"
                                   rel='popover' data-placement='bottom' data-trigger='hover'>
                                    <img src='/public/img/lotto.png'/>
                                </a>
                            <?php } else { ?>
                                <span class="no-icon"></span><span
                                    class="no-lotteries-after-x-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'broker_no_lotteries_text'); ?></span><?php } ?>
                        </td>
                        <td name="lottories2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if (!empty($rightBroker->brokerToLotteries)) { ?>
                                    <?= count($rightBroker->brokerToLotteries); ?>
                                    <br class="hidden-xs">
                                    <a class='popover-toggle hidden-xs' href='#' data-html='true'
                                       data-content="<?php foreach ($rightBroker->brokerToLotteries as $brokerToLottery) { $lottery = $brokerToLottery->lottery; ?>
                                                            <img src='<?= Yii::$app->imageManager->path($lottery->logoImage) ?>' alt='<?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?> - <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$rightBroker->name); ?>' width='110px'/>
                                                        <?php } ?>"
                                       rel='popover' data-placement='bottom' data-trigger='hover'>
                                        <img src='/public/img/lotto.png'/>
                                    </a>
                                <?php } else { ?>
                                    <span class="no-icon"></span><span
                                        class="no-lotteries-after-x-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'broker_no_lotteries_text'); ?></span><?php } ?>
                            <?php endif; ?></td>
                    </tr>
                    <tr class="fsz-14-mobile">
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'welcome bonus list'); ?></td>
                        <td name="bonuses1" broker="1">
                            <?php if (!empty($leftBroker->bonuses)) {
                                foreach ($leftBroker->bonuses as $bonus) { ?>
                                    <p><?= Yii::t(SourceMessage::CATEGORY_BONUSES,$bonus->name); ?></p>
                                <?php }
                            } else { ?>
                                <span class="no-icon"></span>
                            <?php } ?>
                        </td>
                        <td name="bonuses2" broker="2"><?php if ($rightBroker !== null) : ?>
                                <?php if (!empty($rightBroker->bonuses)) {
                                    foreach ($rightBroker->bonuses as $bonus) { ?>
                                        <p><?= Yii::t(SourceMessage::CATEGORY_BONUSES,$bonus->name); ?></p><?php }
                                } else { ?>
                                    <span class="no-icon"></span>
                                <?php } ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic'); ?></td>
                        <td name="systematic1" broker="1">
                            <?php if ($leftBroker->systematic) { ?>
                                <span class="yes-icon"></span>
                            <?php } else { ?>
                                <span class="no-icon"></span>
                            <?php } ?>
                        </td>
                        <td name="systematic2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if($rightBroker->systematic) : ?>
                                    <span class="yes-icon"></span>
                                <?php else: ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Scan ticket'); ?></td>
                        <td name="scan_ticket1" broker="1">
                            <?php if($leftBroker->scanTicket) : ?>
                                <span class="yes-icon"></span>
                            <?php else: ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>

                        <td name="scan_ticket2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if($rightBroker->scanTicket) : ?>
                                    <span class="yes-icon"></span>
                                <?php else: ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Syndicat'); ?></td>
                        <td name="syndicat1" broker="1">
                            <?php if($leftBroker->syndicat) : ?>
                                <span class="yes-icon"></span>
                            <?php else: ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>

                        <td name="syndicat2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if($rightBroker->syndicat) : ?>
                                    <span class="yes-icon"></span>
                                <?php else: ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Monthly visits'); ?></td>
                        <td name="clicks1" broker="1"><?= number_format($leftBroker->clicks, 0, ',', ' '); ?></td>
                        <td name="clicks2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?= number_format($rightBroker->clicks, 0, ',', ' '); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="languages-tr">
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Languages'); ?></td>
                        <td name="languages1" broker="1">
                            <?php foreach ($leftBroker->languages as $language) { ?>
                                <img class='hidden-xs shadows-effect border-radius-effect compare-brokers-items' width='60px'
                                     alt='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
                                     title='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
                                     src='<?= Yii::$app->imageManager->path($language->image); ?>' />
                            <?php } ?>
                            <?php if(count($leftBroker->languages) <= $shown) : ?>
                                <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach($leftBroker->languages as $language) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                    <?php } ?>
                                </div>
                            <?php else: ?>
                                <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach(array_slice($leftBroker->languages,0,$shown) as $language) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($language->image);; ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                    <?php } ?>
                                    <div id="languages-collapse-<?= $leftBroker->id; ?>" class="collapse">
                                        <?php foreach(array_slice($leftBroker->languages,$shown) as $language) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                        <?php } ?>
                                    </div>
                                    <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#languages-collapse-<?= $leftBroker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td name="languages2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php foreach ($rightBroker->languages as $language) { ?>
                                    <img class='hidden-xs shadows-effect border-radius-effect compare-brokers-items' width='60px'
                                         alt='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
                                         title='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
                                         src='<?= Yii::$app->imageManager->path($language->image); ?>' />
                                <?php } ?>
                                <?php if(count($rightBroker->languages) <= $shown) : ?>
                                    <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                        <?php foreach($rightBroker->languages as $language) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                        <?php } ?>
                                    </div>
                                <?php else: ?>
                                    <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
                                        <?php foreach(array_slice($rightBroker->languages,0,$shown) as $language) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                        <?php } ?>
                                        <div id="languages-collapse-<?= $rightBroker->id; ?>" class="collapse">
                                            <?php foreach(array_slice($rightBroker->languages,$shown) as $language) { ?>
                                                <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                                            <?php } ?>
                                        </div>
                                        <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#languages-collapse-<?= $rightBroker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Online since'); ?></td>
                        <td name="year1" broker="1"><?= $leftBroker->year; ?></td>
                        <td name="year2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if ( !empty($rightBroker->year)) : ?>
                                    <?= $rightBroker->year; ?>
                                <?php else: ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Mail'); ?></td>
                        <td name="email1" broker="1">
                            <?php if(!empty($leftBroker->brokerEmails)) : ?>
                                <?php foreach ($leftBroker->brokerEmails as $brokerEmail) : ?>
                                    <?= $brokerEmail->translatedName; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td name="email2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if(!empty($rightBroker->brokerEmails)) : ?>
                                    <?php foreach ($rightBroker->brokerEmails as $brokerEmail) : ?>
                                        <?= $brokerEmail->translatedName; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="payments-tr">
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Deposit Methods'); ?></td>
                        <td name="paymentMethods1" broker="1">
                            <?php if (isset($leftBroker->paymentMethods) && !empty($leftBroker->paymentMethods)) { ?><?php foreach ($leftBroker->paymentMethods as $paymentMethod) { ?>
                                <img class='hidden-xs shadows-effect compare-brokers-items' width='60px'
                                     alt='<?= Yii::t(SourceMessage::CATEGORY_GENERAL,$paymentMethod->name); ?>' title='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name); ?>'
                                     src='<?= Yii::$app->imageManager->path($paymentMethod->image); ?>' /><?php }
                            } else { ?>
                                <span class="no-icon"></span>
                            <?php } ?>
                            <?php if(count($leftBroker->paymentMethods) < $shown) : ?>
                                <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach($leftBroker->paymentMethods as $paymentMethod) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                    <?php } ?>
                                </div>
                            <?php else: ?>
                                <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                    <?php foreach(array_slice($leftBroker->paymentMethods,0,$shown) as $paymentMethod) { ?>
                                        <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                    <?php } ?>
                                    <div id="payments-collapse-<?= $leftBroker->id; ?>" class="collapse">
                                        <?php foreach(array_slice($leftBroker->paymentMethods,$shown) as $paymentMethod) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                        <?php } ?>
                                    </div>
                                    <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#payments-collapse-<?= $leftBroker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td name="paymentMethods2" broker="2"><?php if ($rightBroker !== null) : ?>
                                <?php if (isset($rightBroker->paymentMethods) && !empty($rightBroker->paymentMethods)) { ?><?php foreach ($rightBroker->paymentMethods as $paymentMethod) { ?>
                                    <img class='hidden-xs shadows-effect compare-brokers-items' width='60px'
                                         alt='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name); ?>' title='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name); ?>'
                                         src='<?= Yii::$app->imageManager->path($paymentMethod->image); ?>' /><?php }
                                } else { ?><span class="no-icon"></span>
                                <?php } ?>
                                <?php if(count($rightBroker->paymentMethods) < $shown) : ?>
                                    <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                        <?php foreach($rightBroker->paymentMethods as $paymentMethod) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                        <?php } ?>
                                    </div>
                                <?php else: ?>
                                    <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
                                        <?php foreach(array_slice($rightBroker->paymentMethods,0,$shown) as $paymentMethod) { ?>
                                            <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                        <?php } ?>
                                        <div id="payments-collapse-<?= $rightBroker->id; ?>" class="collapse">
                                            <?php foreach(array_slice($rightBroker->paymentMethods,$shown) as $paymentMethod) { ?>
                                                <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                                            <?php } ?>
                                        </div>
                                        <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#payments-collapse-<?= $rightBroker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Online Chat'); ?></td>
                        <td name="chat1" broker="1">
                            <?php if($leftBroker->chat) : ?>
                                <span class="yes-icon"></span>
                            <?php else: ?>
                                <span class="no-icon"></span>
                            <?php endif; ?>
                        </td>
                        <td name="chat2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if($rightBroker->chat) : ?>
                                    <span class="yes-icon"></span>
                                <?php else: ?>
                                    <span class="no-icon"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr class="compare-agents-buttons-tr">
                        <td><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Action'); ?></td>
                        <td name="action1" broker="1">
                            <?php if($leftBroker->hasReviewPage()) : ?>
                                <a href="<?= $leftBroker->reviewPage->pageContentByLanguage->fullUrl; ?>" class="link compare-agents-review-button"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review'); ?></a>
                            <?php endif; ?>
                            <br class="hidden-xs">
                            <?php if(isset($leftBroker->site) && !empty($leftBroker->site) && $leftBroker->isPositive()) : ?>
                                <a href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$leftBroker->site); ?>" class="button-red compare-agents-site-button" target="_blank" rel="nofollow"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Site'); ?></a>
                            <?php endif; ?>
                        </td>
                        <td name="action2" broker="2">
                            <?php if ($rightBroker !== null) : ?>
                                <?php if($rightBroker->hasReviewPage()) : ?>
                                    <a href="<?= $rightBroker->reviewPage->pageContentByLanguage->fullUrl; ?>" class="link compare-agents-review-button"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review'); ?></a>
                                <?php endif; ?>
                                <br class="hidden-xs">
                                <?php if(isset($rightBroker->site) && !empty($rightBroker->site) && $rightBroker->isPositive()) : ?>
                                    <a href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$rightBroker->site); ?>" class="button-red compare-agents-site-button" target="_blank" rel="nofollow"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Site'); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm col-md-1"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= Yii::$app->pageData->pageContent->content2; ?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $rightBannerBlock ?>
    </div>
</div>
<?php $this->registerJsFile('/public/js/compare-brokers.js',['depends' => AppAsset::class]); ?>
