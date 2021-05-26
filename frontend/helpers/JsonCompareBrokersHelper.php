<?php

namespace frontend\helpers;

use \common\models\records\SourceMessage;
use \common\models\records\Broker;
use Yii;

class JsonCompareBrokersHelper
{
    public static function initializeData(Broker $broker)
    {

        $shown = 2; // shown languages or paymnents for mobile
        $data = [
            'broker_name' => '',
            'bonuses' => '',
            'systematic' => '',
            'scan_ticket' => '',
            'languages' => '',
            'syndicat' => '',
            'paymentMethods' => '',
            'phones' => '',
            'year' => '',
            'email' => '',
            'chat' => '',
            'clicks' => '',
            'action' => '',
            'lottories' => '',
        ];
        ob_start();
        ?>

        <span class="hidden-xs">
            <?php if (!empty($broker->site) && $broker->isPositive() && $broker->hasReviewPage()) : ?>
                <a class="broker_description" href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$broker->site) ?>"
                   rel="nofollow" target="blank" data-html="true"
                   data-content="<?= $broker->reviewPage->pageContentByLanguage->additionalDescription; ?>"
                   rel="popover" data-placement="right">
                    <img alt="<?= $broker->name; ?>"
                         src="<?= Yii::$app->imageManager->path($broker->image); ?>">
                </a>
            <?php else: ?>
                <img alt="<?= $broker->name; ?>"
                     src="<?= Yii::$app->imageManager->path($broker->image); ?>">
            <?php endif; ?>
        </span>
        <span class="hidden-sm hidden-md hidden-lg"><?= $broker->name; ?></span>

        <?php
        $data['broker_name'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>

        <?php if (!empty($broker->brokerToLotteries)) { ?>
        <?= count($broker->brokerToLotteries); ?>
        <br class="hidden-xs">
        <a class='popover-toggle hidden-xs' href='#' data-html='true'
           data-content="<?php foreach ($broker->brokerToLotteries as $brokerToLottery) { $lottery = $brokerToLottery->lottery; ?>
                                                            <img src='<?= Yii::$app->imageManager->path($lottery->logoImage) ?>' alt='<?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?> - <?= Yii::t(SourceMessage::CATEGORY_BROKERS,$broker->name); ?>' width='110px'/>
                                                        <?php } ?>"
           rel='popover' data-placement='bottom' data-trigger='hover'>
            <img src='/public/img/lotto.png'/>
        </a>
    <?php } else { ?>
        <span class="no-icon"></span><span
                class="no-lotteries-after-x-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'broker_no_lotteries_text'); ?></span><?php } ?>

        <?php
        $data['lottories'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if (!empty($broker->bonuses)) {
        foreach ($broker->bonuses as $bonus) { ?>
            <p><?= Yii::t(SourceMessage::CATEGORY_BONUSES,$bonus->name); ?></p><?php }
    } else { ?>
        <span class="no-icon"></span>
    <?php } ?>

        <?php
        $data['bonuses'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>

        <?php if($broker->systematic) : ?>
        <span class="yes-icon"></span>
    <?php else: ?>
        <span class="no-icon"></span>
    <?php endif; ?>

        <?php
        $data['systematic'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>

        <?php if($broker->scanTicket) : ?>
        <span class="yes-icon"></span>
    <?php else: ?>
        <span class="no-icon"></span>
    <?php endif; ?>

        <?php
        $data['scan_ticket'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if($broker->syndicat) : ?>
        <span class="yes-icon"></span>
    <?php else: ?>
        <span class="no-icon"></span>
    <?php endif; ?>
        <?php
        $data['syndicat'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?= number_format($broker->clicks, 0, ',', ' '); ?>
        <?php
        $data['clicks'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php foreach ($broker->languages as $language) { ?>
        <img class='hidden-xs shadows-effect border-radius-effect compare-brokers-items' width='60px'
             alt='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
             title='<?= Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name); ?>'
             src='<?= Yii::$app->imageManager->path($language->image); ?>' />
    <?php } ?>
        <?php if(count($broker->languages) <= $shown) : ?>
        <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
            <?php foreach($broker->languages as $language) { ?>
                <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
            <?php } ?>
        </div>
    <?php else: ?>
        <div class="brokers-languages-mobile hidden-sm hidden-md hidden-lg">
            <?php foreach(array_slice($broker->languages,0,$shown) as $language) { ?>
                <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
            <?php } ?>
            <div id="languages-collapse-<?= $broker->id; ?>" class="collapse">
                <?php foreach(array_slice($broker->languages,$shown) as $language) { ?>
                    <img src="<?= Yii::$app->imageManager->path($language->image); ?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$language->name);?>" width="60px"/>
                <?php } ?>
            </div>
            <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#languages-collapse-<?= $broker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
        </div>
    <?php endif; ?>
        <?php
        $data['languages'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if ( !empty($broker->year)) : ?>
        <?= $broker->year; ?>
    <?php else: ?>
        <span class="no-icon"></span>
    <?php endif; ?>
        <?php
        $data['year'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if(!empty($broker->brokerEmails)) : ?>
        <?php foreach ($broker->brokerEmails as $brokerEmail) : ?>
            <?= $brokerEmail->translatedName; ?>
        <?php endforeach; ?>
    <?php endif; ?>
        <?php
        $data['email'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if (isset($broker->paymentMethods) && !empty($broker->paymentMethods)) { ?><?php foreach ($broker->paymentMethods as $paymentMethod) { ?>
        <img class='hidden-xs shadows-effect compare-brokers-items' width='60px'
             alt='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name); ?>' title='<?= Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name); ?>'
             src='<?= Yii::$app->imageManager->path($paymentMethod->image); ?>' /><?php }
    } else { ?><span class="no-icon"></span>
    <?php } ?>
        <?php if(count($broker->paymentMethods) < $shown) : ?>
        <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
            <?php foreach($broker->paymentMethods as $paymentMethod) { ?>
                <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
            <?php } ?>
        </div>
    <?php else: ?>
        <div class="brokers-payments-mobile hidden-sm hidden-md hidden-lg">
            <?php foreach(array_slice($broker->paymentMethods,0,$shown) as $paymentMethod) { ?>
                <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
            <?php } ?>
            <div id="payments-collapse-<?= $broker->id; ?>" class="collapse">
                <?php foreach(array_slice($broker->paymentMethods,$shown) as $paymentMethod) { ?>
                    <img src="<?= Yii::$app->imageManager->path($paymentMethod->image); ?>" width="60px"  alt="<?=Yii::t(SourceMessage::CATEGORY_PAYMENT_METHODS,$paymentMethod->name);?>"/>
                <?php } ?>
            </div>
            <a href="javascript:;" class="small-collapser" data-toggle="collapse" data-target="#payments-collapse-<?= $broker->id; ?>" aria-expanded="false"><span class="text-to-show"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All'); ?> ></span><span class="text-to-hide">< <?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Hide'); ?></span></a>
        </div>
    <?php endif; ?>
        <?php
        $data['paymentMethods'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if($broker->chat) : ?>
        <span class="yes-icon"></span>
    <?php else: ?>
        <span class="no-icon"></span>
    <?php endif; ?>
        <?php
        $data['chat'] = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <?php if($broker->hasReviewPage()) : ?>
        <a href="<?= $broker->reviewPage->pageContentByLanguage->fullUrl; ?>" class="link compare-agents-review-button"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review'); ?></a>
    <?php endif; ?>
        <br class="hidden-xs">
        <?php if(isset($broker->site) && !empty($broker->site) && $broker->isPositive()) : ?>
        <a href="<?= Yii::t(SourceMessage::CATEGORY_BROKER_LINKS,$broker->site); ?>" class="button-red compare-agents-site-button" target="_blank" rel="nofollow"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Site'); ?></a>
    <?php endif; ?>
        <?php
        $data['action'] = ob_get_contents();
        ob_end_clean();

        return $data;

    }
}