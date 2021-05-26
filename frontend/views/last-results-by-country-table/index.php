<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <article>
            <?=Yii::$app->pageData->pageContent->content1;?>
        </article>
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