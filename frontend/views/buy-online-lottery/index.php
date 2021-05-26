<?php
use yii\helpers\Html;
use \common\models\records\SourceMessage;
use \common\models\records\Page;
/* @var \common\models\records\Lottery $lottery */
/* @var \common\models\records\Broker[] $brokers */

?>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <?= isset($lotteryHeadBlock) ? $lotteryHeadBlock : ''; ?>
        <article class="mobile-contained-row">
            <?=Yii::$app->pageData->pageContent->content1;?>
        </article>
        <div class="col-lg-12 col-md-12 col-sm-12 buy-online-steps-circles">
            <div class="buy-step buy-step-1 clearfix col-lg-4 col-md-4 col-sm-4 "><center><span class="number-step">1</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Lottery');?></span></center></div>
            <div class="buy-step clearfix col-lg-4 col-md-4 col-sm-4 active" ><center><span class="number-step">2</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Broker');?></span></center></div>
            <div class="buy-step clearfix col-lg-4 col-md-4 col-sm-4 "><center><span class="number-step">3</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Numbers');?></span></center></div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
            <div class="row buy-online-lotto-brokers-top">
                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs"><a href="<?=Yii::$app->pageData->menuPages[Page::MODULE_BUY_ONLINE_TABLE]->pageContentByLanguage->fullUrl;?>"><img width="80px" src="/public/img/icon_lotto_2.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottories');?>"/><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottories');?></a></div>
                <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs active" ><img width="80px" src="/public/img/icon_broker.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Brokers');?>"/><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Brokers');?></div>
            </div>
        </div>

        <table id="broker-online-buy" class="compare-table table-bordered-top-mobile" data-toggle="table" data-height="850" data-pagination="true" data-page-size="<?=Yii::$app->pageData->settings[\common\models\records\Setting::AMOUNT_OF_BROKERS_BUY_ONLINE_LOTTERY]->value;?>">
            <thead class="hidden-xs">
            <tr>
                <th data-field="name"
                    data-align="center"
                    data-sortable="true">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Broker');?>
                </th>
                <th data-field="syndicat"
                    data-align="center"
                    data-sortable="true">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Syndicat');?>
                </th>
                <th data-field="Bonuses"
                    data-align="center"
                    data-sortable="true">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Bonuses');?>
                </th>
                <th data-field="Systematic"
                    data-align="center"
                    data-sortable="false">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic');?>
                </th>
                <th data-field="price"
                    data-align="center"
                    data-sorter="priceSorter"
                    data-sortable="true">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Ticket Price');?>
                </th>
                <th data-field="scan"
                    data-align="center"
                    data-sortable="false">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'scan-ticket');?>
                </th>
                <th data-field="action"
                    data-align="center">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Action');?>
                </th>
            </tr>
            </thead>
            <tbody id="brokers">
            <? $i = 0;
            foreach ($lottery->brokerToLotteries as $brokerToLottery) { $broker = $brokerToLottery->broker; ?>
                <? if(($isPositive = $broker->isPositive()) || Yii::$app->request->get('broker_id',null) == $broker->id) : ?>
                    <? if($isPositive) { $i++; } ?>
                    <tr>
                        <td class="main-page-brokers-logo">
                            <?= Html::img(Yii::$app->imageManager->path($broker->status->listImage),['class' => 'testedBroker hidden-sm']); ?>

                            <br class="hidden-xs">
                            <a href="<?=Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$brokerToLottery->url);?>" rel="nofollow" target="blank"><img width="150" src='<?= Yii::$app->imageManager->path($broker->image); ?>' alt='<?=Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name);?>'/></a>
                            <br class="hidden-xs">
                            <?php if($broker->hasReviewPage()) : ?>
                                <a class="hidden-xs" href="<?=$broker->reviewPage->pageContentByLanguage->fullUrl;?>"><?=Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name);?></a>
                            <?php else : ?>
                                <span><?=Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name);?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Syndicat');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data">
                                    <?php if($broker->syndicat) : ?>
                                        <span class="yes-icon"></span>
                                    <?php else: ?>
                                        <span class="no-icon"></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Bonuses');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data buy-online-bonuses">
                                    <? if(!empty($broker->bonuses)){?>
                                        <?php foreach ($broker->bonuses as $bonus) : ?>
                                            <?= Yii::t(SourceMessage::CATEGORY_BONUSES,$bonus->name); ?>
                                        <?php endforeach; ?>
                                    <? } else { ?>
                                        <div class="no-icon"></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Systematic');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data">
                                    <? if($broker->systematic) : ?>
                                        <span class="yes-icon"></span>
                                    <?php else: ?>
                                        <span class="no-icon"></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Ticket Price');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data">
                                    <span class="money ticket-price"><?=$brokerToLottery->price;?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="row mobile-contained-row">
                                <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'scan-ticket');?>
                                </div>
                                <div class="col-xs-6 col-sm-12 expanded-data">
                                    <?php if($broker->scanTicket) : ?>
                                        <span class="yes-icon"></span>
                                    <?php else : ?>
                                        <span class="no-icon"></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="mt-20-mobile">
                            <?if(!empty($brokerToLottery->url)) : ?>
                                <a target='blank' rel='nofollow' class='shadows-effect border-radius-effect button-red mobile-single-link' href='<?= Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$brokerToLottery->url); ?>' target='_blank'>
                                <span class="mobile-container">
                                    <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Buy Now'); ?>
                                    <span class="double-arrow"></span>
                                </span>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <? endif; ?>
            <? } ?>
            </tbody>
        </table>
        <? if($i > Yii::$app->pageData->settings[\common\models\records\Setting::AMOUNT_OF_BROKERS_BUY_ONLINE_LOTTERY]->value)
        { ?>
            <div class="row-mobile-only">
                <a id="paginationsToggle" class="mobile-single-link pull-right main-page-allResults buy-step-2-pagination" href="javascript:;">
                <span class="mobile-container">
                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'View All');?>
                    <span class="double-arrow double-arrow-white"></span>
                </span>
                </a>
            </div>
        <? } ?>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 expandable-mobile-container no-padding-mobile">
        <?=Yii::$app->pageData->pageContent->content2;?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>