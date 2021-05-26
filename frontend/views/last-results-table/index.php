<?php
use common\models\records\SourceMessage;
/* @var \common\models\records\Page[] $countriesResultsPages */
?>
<section class="row results-page">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
        <article class="mobile-container">
            <?=Yii::$app->pageData->pageContent->content1;?>
        </article>
        <div class="collapsible-mobile-menu choose-country-mobile-menu">
            <a href="javascript:;" class="collapsible-mobile-link" data-toggle="collapse" data-target="#countriesSelect" aria-expanded="true">
            <span class="mobile-container">
                <span class="collapsible-menu-title hidden-sm hidden-md hidden-lg"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Choose country'); ?></span>
                <span class="collapsible-menu-arrow">
                    <i class="glyphicon glyphicon-chevron-right"></i>
                </span>
            </span>
            </a>
            <div class="mobile-container">
                <section id="countriesSelect" class="collapse in">
                    <? foreach($countriesResultsPages as $countryResultsPage){ ?>
                        <a class="mobile-single-link" href="<?=$countryResultsPage->pageContentByLanguage->fullUrl;?>" title="<?= Yii::t(SourceMessage::CATEGORY_COUNTRIES,$countryResultsPage->country->name); ?>">
                            <img alt="<?= Yii::t(SourceMessage::CATEGORY_COUNTRIES,$countryResultsPage->country->name); ?>" class="results-page-flags-to-country-results" src='<?= Yii::$app->imageManager->path($countryResultsPage->country->image); ?>' />
                            <span class="country-title">
                            <?= Yii::t(SourceMessage::CATEGORY_COUNTRIES,$countryResultsPage->country->name); ?>
                        </span>
                            <span class="double-arrow double-arrow-purple"></span>
                        </a>
                    <? } ?>
                </section>
            </div>
        </div>
        <?= $this->render('@app/views/ui/results-table', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'defaultBroker' => $defaultBroker,
            'promotingBroker' => $promotingBroker
        ]) ?>
    </div>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <?=Yii::$app->pageData->pageContent->content2;?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>