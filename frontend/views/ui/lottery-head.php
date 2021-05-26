<?php
use \common\models\records\SourceMessage;
/* @var \common\models\records\Lottery $lottery  */
?>
<div class="row lottery-head-body">
    <div class="col-sm-4 col-xs-12 head-container">
        <div class="lottery-head lottery-logo-container row-mobile-only">
            <div class="mobile-container">
                <div class="col-xs-3 hidden-sm hidden-md hidden-lg no-padding-mobile"><span class="lottery-icon"></span></div>
                <div class="col-xs-6 col-sm-12 no-padding-mobile">
                    <img class="lottery-logo" src="<?=Yii::$app->imageManager->path($lottery->logoImage);?>" alt="<?=$lottery->name;?>">
                </div>
                <div class="col-xs-3 hidden-sm hidden-md hidden-lg no-padding-mobile">
                    <span class="head-title"><?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12 head-container">
        <div class="lottery-head lottery-jackpot-container row-mobile-only">
            <div class="mobile-container">
                <div class="col-xs-3 hidden-sm hidden-md hidden-lg no-padding-mobile"><span class="jackpot-icon"></span></div>
                <div class="col-xs-3 col-sm-12 to-right-mobile no-padding-mobile jackpot-title-in-head">
                    <span class="head-title lotto-page-timer"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'JackPot');?></span>
                </div>
                <div class="col-xs-6 col-sm-12 no-padding-mobile lottery-head-money-container">
                    <span class="money lotto-page-timer is-a-jackpot" <?php if($lottery->hasCurrency()) { ?>data-special-currency-id="<?= $lottery->country->currencyId; ?>"<?php } ?>
                    ><?=$lottery->jackpot;?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-xs-12 head-container">
        <div class="lottery-head lottery-next-draw-container row-mobile-only">
            <div class="mobile-container">
                <div class="col-xs-3 hidden-sm hidden-md hidden-lg no-padding-mobile"><span class="next-draw-icon"></span></div>
                <div class="col-xs-3 col-sm-12 to-right-mobile no-padding-mobile">
                    <span class="head-title lotto-page-timer"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Next Draw');?></span>
                </div>
                <div class="col-xs-6 col-sm-12 no-padding-mobile">
                    <span class="timer lotto-page-timer" time="<?=$lottery->nextDraw;?>"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
