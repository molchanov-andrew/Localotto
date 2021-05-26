<?php
use \common\models\records\SourceMessage;
use frontend\assets\AppAsset;
use common\models\records\Setting;

/* @var \common\models\records\Lottery[] $lotteries */
?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
                <div class="row tools-random-numbers">
                    <div class="col-lg-8" class="controls">
                        <div class="row choose-numbers-control-panel">
                            <div>
                                <select id="lotto" style="width:50%">
                                    <?php foreach ($lotteries as $lottery) :  ?>
                                    <?php if($lottery->hasBuyOnlinePage()) :   ?>
                                        <option data-main-range="<?= $lottery->mainNumbers; ?>"
                                                data-main-quantity="<?= $lottery->mainNumbersToCheck; ?>"
                                                data-bonus-range="<?= $lottery->addNumbers; ?>"
                                                data-bonus-quantity="<?= $lottery->addNumbersToCheck; ?>"
                                                data-lottery-id="<?= $lottery->id ?>"
                                                data-default-id="<?= Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value; ?>"
                                                data-advert-id="<?= Yii::$app->pageData->pageContent->page->promotingBrokerId ?>"
                                                data-lang-code="<?= Yii::$app->language; ?>"><?= Yii::t(SourceMessage::CATEGORY_LOTTERIES,$lottery->name); ?></option>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" id="birthday" style="width:50%" class="form-control" placeholder="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Put your date of birthday: 12/02/1990');?>">
                            </div>
                            <div>
                                <button style="width:50%" class="button-red help-to-choose"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Generate');?></button>
                            </div>
                            <div class="row numbers-for-user">
                                <div class="inline-numbers">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 hidden-xs" style="min-height:250px">
                        <div id="clock">
                            <div class="jqc-clock-face"></div>
                        </div>
                    </div>
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
<?php $this->registerJsFile('/public/js/jqClock.js',['depends' => AppAsset::class]); ?>
<?php $this->registerJsFile('/public/js/toolRandomNumbers.js',['depends' => AppAsset::class]); ?>
<link rel="stylesheet" href="/public/css/jqClock.css"/>