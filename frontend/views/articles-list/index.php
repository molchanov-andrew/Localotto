<?php
use \common\models\records\SourceMessage;
/* @var \common\models\records\Page[] $articlePages */
?>
<div class="row news-catalog">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mobile-contained-row">
                <?= Yii::$app->pageData->pageContent->content1; ?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 ">
                <?php foreach ($articlePages as $page) : ?>
                    <div class="row news-catalog-articles">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 no-padding-mobile">
                            <img class="picture" src="<?= Yii::$app->imageManager->path($page->pageContentByLanguage->image); ?>" alt="<?= $page->pageContentByLanguage->alternativeDescription ;?>">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 no-padding-mobile">
                            <a href="<?= $page->pageContentByLanguage->fullUrl; ?>">
                                <h3><?= $page->pageContentByLanguage->title; ?></h3>
                            </a>
                            <span class="mobile-container">
                        <p><?= $page->pageContentByLanguage->additionalDescription; ?></p>
                        <p>
                            <a class="news-more-link pull-right link" href="<?= $page->pageContentByLanguage->fullUrl; ?>">
                                <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'More');?><span class="hidden-xs">>></span>
                            </a>
                            <div class="clearfix"></div>
                        </p>
                    </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
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
        <?= $rightBannerBlock; ?>
    </div>
</div>
<script src="/public/js/fix-banner.js"></script>
<!--<script src="/public/js/disableSelection.js"></script>-->
