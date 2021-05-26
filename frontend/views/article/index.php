<div class="row news-page">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12 no-padding-mobile">
                <img class="article-image" src="<?= Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->image); ?>" alt="<?= Yii::$app->pageData->pageContent->alternativeDescription ;?>">
                <article class="mobile-container">
                    <?= Yii::$app->pageData->pageContent->content1; ?>
                </article>
            </div>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
        <section class="row">
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
            <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mobile-contained-row">
                <?= Yii::$app->pageData->pageContent->content2; ?>
            </article>
            <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
        </section>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?= $rightBannerBlock; ?>
    </div>
</div>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "NewsArticle",
  "headline": "<?= Yii::$app->pageData->pageContent->title ;?>",
  "image": [
    "http://<?=$_SERVER['HTTP_HOST'] . Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->image);?>"
  ],
  "datePublished": "2015-02-05T08:00:00+08:00",
  "description": "<?= Yii::$app->pageData->pageContent->additionalDescription ;?>",
  "articleBody": "<?=str_replace(array("\r\n", "\r", "\n"), '', substr(strip_tags(urldecode(Yii::$app->pageData->pageContent->content1)),0, 300));?>"
}
</script>
