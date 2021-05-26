
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mobile-contained-row">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <?= Yii::$app->pageData->pageContent->content1; ?>
            </article>
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