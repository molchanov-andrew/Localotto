
<table id="align-circles" class="compare-table results-table" data-toggle="table" data-sort-name="date" data-sort-order="desc" data-height="860" data-id="results-table" data-pagination="true" data-page-size="100">
    <thead>
    <tr>
        <th data-field="name"
            data-align="center"
            data-sortable="true">
            <span class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Logo');?></span>
        </th>
        <th data-field="country"
            data-align="center"
            data-sortable="true">
            <span class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'country');?></span>
        </th>
        <th data-field="date"
            data-align="center">
            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Date');?>
        </th>
        <th data-field="addNumbers"
            data-align="center">
            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Numbers');?>
        </th>
        <th data-field="action"
            data-align="center">
            <span class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Action');?></span>
        </th>
    </tr>
    </thead>
    <tbody>
    <?foreach ($lotteries as $lottery) { ?>
        <tr>
            <td class="lottery-table-image" order="<?=$lottery->name;?>">
                <? if ($lottery->hasReviewPage()):?><a href="<?=$lottery->reviewPage->pageContentByLanguage->fullUrl;?>"><? endif; ?>
                    <img alt="<?=$lottery->name;?>" src='<?=Yii::$app->imageManager->path($lottery->logoImage);?>' />
                    <? if ($lottery->hasReviewPage()):?> </a><? endif; ?>
                <br class="hidden-xs">
                <span class="hidden-xs"><?=Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name);?></span>
            </td>
            <td class="lottery-table-country">
                <img class="hidden-xs" alt="<?=Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name);?>" src='<?= Yii::$app->imageManager->path($lottery->country->image); ?>' />
                <br class="hidden-xs">
                <span><?=Yii::t(SourceMessage::CATEGORY_COUNTRIES,$lottery->country->name);?></span>
            </td>
            <td class="lottery-table-draw">
                <span date="<?=$lottery->latestLotteryResult->getNativeDatetime()->format('d-m-Y');?>">
                    <?= OldHelper::formatResultsData($lottery->latestLotteryResult->getNativeDatetime())  ?>
                </span>
            </td>
            <td class="lottery-table-numbers" order="<?=$lottery->latestLotteryResult->mainNumbers;?>">
                <div class="mobile-container">
                    <?= \frontend\widgets\Numbers::widget(['lotteryResult' => $lottery->latestLotteryResult]); ?>
                </div>
            </td>
            <td class="lottery-table-actions">
                <div class="results-page-Action-buttons">
                    <? if ($lottery->hasReviewPage()):?>
                        <a class="button-for-mobile_2 mobile-single-link" href="<?=$lottery->reviewPage->pageContentByLanguage->fullUrl;?>">
                            <span class="mobile-container">
                                <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottery Info');?> <span class="no-arrows hidden-xs">>></span>
                                <span class="double-arrow double-arrow-purple"></span>
                            </span>
                        </a>
                    <? endif;?>
                    <? if($lottery->hasBuyOnlinePage()) {?>
                        <a class="shadows-effect border-radius-effect button-red mobile-single-link" href="<?=$lottery->buyOnlinePage->pageContentByLanguage->fullUrl;?>">
                            <span class="mobile-container">
                                <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare Ticket Prices');?>
                                <span class="double-arrow"></span>
                            </span>
                        </a>
                    <? } ?>
                </div>
                <?if(isset($promotingBroker, $promotingBroker->brokerToLotteries[$lottery->id])):?>
                    <a class="shadows-effect border-radius-effect button-red new-button-lotosend mobile-single-link" href="<?=Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$promotingBroker->brokerToLotteries[$lottery->id]->url);?>" target="_blank" rel="nofollow">
                        <span class="mobile-container">
                            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Play with');?>  <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$promotingBroker->name) ;?>
                            <span class="double-arrow"></span>
                        </span>
                    </a>
                <? else:  ?>
                    <? if(isset($defaultBroker, $defaultBroker->brokerToLotteries[$lottery->id])): ?>
                        <a class="shadows-effect border-radius-effect button-red new-button-thelotter mobile-single-link" href="<?=Yii::t(SourceMessage::CATEGORY_BROKER_TO_LOTTERY_LINK,$defaultBroker->brokerToLotteries[$lottery->id]->url);?>" target="_blank" rel="nofollow">
                            <span class="mobile-container">
                                <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Play with');?>  <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$defaultBroker->name) ;?>
                                <span class="double-arrow"></span>
                            </span>
                        </a>
                    <? endif; ?>
                <? endif; ?>
            </td>
        </tr>
    <? } ?>
    </tbody>
</table>