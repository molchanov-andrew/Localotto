<?php 

use \common\models\records\SourceMessage;
/* @var \common\models\records\Lottery[] $lotteries */
?>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <article class="mobile-container">
            <?=Yii::$app->pageData->pageContent->content1;?>
        </article>
        <div class="row mobile-contained-row">
            <div class="col-lg-12 col-md-12 col-sm-12 buy-online-steps-circles no-padding-mobile">
                <div class="row">
                    <div class="buy-step clearfix col-lg-4 col-md-4 col-sm-4 <?=((!isset($_POST->id))?'active':'');?>"><center><span class="number-step">1</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Lottery');?></span></center></div>
                    <div class="buy-step clearfix col-lg-4 col-md-4 col-sm-4 <?=((isset($_POST->id))?'active':'');?>" ><center><span class="number-step">2</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Broker');?></span></center></div>
                    <div class="buy-step clearfix col-lg-4 col-md-4 col-sm-4 "><center><span class="number-step">3</span><span class="description-step"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose Numbers');?></span></center></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs no-padding-mobile">
                <div class="row buy-online-lotto-brokers-top general-buy-online">
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs <?=((!isset($_POST->id))?'active':'');?>"><img width="60px" src="/public/img/icon_lotto.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottories');?>"/><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottories');?></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 hidden-xs <?=((isset($_POST->id))?'active':'');?>" ><img width="60px" src="/public/img/icon_broker_2.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Brokers');?>"/><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Brokers');?></div>
                </div>
            </div>
        </div>

        <? if(!isset($brokers)): ?>
            <div class="buy-online-table-container">
                <table id="buy-ticket" class="compare-table buy-online-table table-bordered-top-mobile" data-toggle="table" data-sort-name="jackpot" data-sort-order="desc" data-height="850" data-pagination="true" data-page-size="100">
                    <thead class="hidden-xs">
                    <tr>
                        <th data-field="name"
                            data-align="center"
                            data-sortable="true">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottery');?>
                        </th>
                        <th data-field="country"
                            data-align="center"
                            data-sortable="true">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'country');?>
                        </th>
                        <th data-field="jackpot"
                            data-align="center"
                            data-sorter="jackpotSorter"
                            data-sort-name="_jackpot_data"
                            data-sortable="true">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'next jackpots');?>
                        </th>
                        <th data-field="draw"
                            data-align="center"
                            data-sortable="false">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'next draw');?>
                        </th>
                        <th data-field="price"
                            data-align="center"
                            data-sorter="priceSorter"
                            data-sortable="true">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Ticket Price');?>
                        </th>
                        <th data-field="action"
                            data-align="center">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Action');?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    foreach ($lotteries as $lottery) {
                        if($lottery->hasBuyOnlinePage()) { ?>
                            <tr>
                                <td class="main-page-brokers-logo" order="<?=$lottery->name;?>"><img alt="<?=$lottery->name;?>" src='<?= Yii::$app->imageManager->path($lottery->logoImage); ?>' /><br><span class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);?></span></td>
                                <td>
                                    <div class="row mobile-contained-row">
                                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'country');?>
                                        </div>
                                        <div class="col-xs-6 col-sm-12 expanded-data">
                                            <img alt="<?=$lottery->country->name;?>" src='<?= Yii::$app->imageManager->path($lottery->country->image); ?>' />
                                            <br class="hidden-xs"><center class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name);?></center>
                                        </div>
                                    </div>
                                </td>
                                <td data-jackpot="<?=$lottery->jackpot;?>">
                                    <div class="row mobile-contained-row">
                                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'next jackpots');?>
                                        </div>
                                        <div class="col-xs-6 col-sm-12 expanded-data">
                                            <span class="money is-a-jackpot" <?php if($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>><?=$lottery->jackpot;?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mobile-contained-row">
                                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'next draw');?>
                                        </div>
                                        <div class="col-xs-6 col-sm-12 expanded-data">
                                            <div class="timer-case"> <span class="timer" style="display:block; width:100%; height:100%;" time="<?=$lottery->nextDraw;?>"><?=$lottery->nextDraw;?></span></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row mobile-contained-row">
                                        <div class="col-xs-6 hidden-sm hidden-md hidden-lg mobile-title">
                                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Ticket Price');?>
                                        </div>
                                        <div class="col-xs-6 col-sm-12 expanded-data">
                                            <span class="money ticket-price"><?=$lottery->cost;?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="mt-20-mobile buy-online-action">
                                    <span><a class="shadows-effect border-radius-effect button-red mobile-single-link" href="<?=$lottery->buyOnlinePage->pageContentByLanguage->fullUrl;?>">
                                    <span class="mobile-container">
                                        <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Next');?>
                                        <span class="double-arrow double-arrow-transparent visible-xs"></span>
                                    </span>
                                    </a>
                                </td>
                            </tr>
                        <? }} ?>
                    </tbody>
                </table>
            </div>
        <? endif;?>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mobile-contained-row">
        <?=Yii::$app->pageData->pageContent->content2;?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>