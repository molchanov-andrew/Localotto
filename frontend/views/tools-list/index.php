<?php
use \common\models\records\SourceMessage;
/* @var \common\models\records\Page[] $toolsPages */
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= Yii::$app->pageData->pageContent->content1; ?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?
                foreach ($toolsPages as $page) { ?>
                    <div class="row news-catalog-articles">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <img class="picture" src="<?= Yii::$app->imageManager->path($page->pageContentByLanguage->image); ?>" alt="<?= $page->pageContentByLanguage->title; ?>">
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            <a href="<?= $page->pageContentByLanguage->fullUrl; ?>">
                                <h3><?= $page->pageContentByLanguage->title; ?></h3></a>
                            <p><?= $page->pageContentByLanguage->additionalDescription; ?></p>
                            <p>
                                <a class="shadows-effect border-radius-effect pull-right button-red" href="<?= $page->pageContentByLanguage->fullUrl ;?>"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Read more');?></a>
                            </p>
                        </div>
                    </div>
                <? } ?>
                <!-- <h1><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Sorry, tools is not avalible now!');?></h1>
                <p><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'This is page will be avalible coming soon.');?></p>
                <img class="tools-construct-images" src="/public/img/constraction_localotto.jpg" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'This is page will be avalible coming soon.');?>"> -->
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
</div>