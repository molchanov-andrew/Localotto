<?php
use \common\models\records\SourceMessage;
?>

<?php if(Yii::$app->pageData->pageContent->rightTopBanner == !null) : ?>
    <div class="hidden-sm hidden-xs">
        <a class="show-lotteries" rel="nofollow" href="<?=Yii::$app->pageData->pageContent->rightTopBanner->link;?>" target="blank">
            <img class="right-banner-images" src="<?= Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->rightTopBanner->image); ?>">
        </a>
    </div>
<?php else: ?>

    <div class="hidden-sm hidden-xs">
        <a class="show-lotteries" rel="nofollow" href="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_link');?>" target="blank">
            <img class="right-banner-images" src="/public/img/right-banners/<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_image');?>" alt="<?Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_alt');?>">
        </a>
    </div>
    <?php if(Yii::$app->pageData->pageContent->page->module === \common\models\records\Page::MODULE_BROKER) : ?>
        <div class="mobile-banner-row row hidden-lg hidden-md hidden-sm">
            <a href="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_link'); ?>" rel="nofollow" target="_blank">
                <img src="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_mobile_banner_image'); ?>" alt="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_alt'); ?>">
            </a>
        </div>
        <div class="tablet-banner-row row hidden-lg hidden-md hidden-xs">
            <a href="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_link'); ?>" rel="nofollow" target="_blank">
                <img src="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_tablet_banner_image'); ?>" alt="<?= Yii::t(SourceMessage::CATEGORY_GENERAL,'default_banner_alt'); ?>">
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(Yii::$app->pageData->pageContent->rightBottomBanner !== null): ?>
    <a class="hidden-sm hidden-xs show-lotteries" rel="nofollow" href="<?= Yii::$app->pageData->pageContent->rightBottomBanner->link; ?>" target="blank">
        <img class="right-banner-images" src="<?= Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->rightTopBanner->image); ?>">
    </a>
<?php endif; ?>