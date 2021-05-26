<?php
use \common\models\records\SourceMessage;
use frontend\helpers\OldHelper;
/* @var \common\models\records\LotteryResult[] $lastResults */
$firstResult = reset($lastResults);
$lastResults = array_slice($lastResults,0,5);
?>
<div class="results-carousel-container hidden-sm hidden-md hidden-lg">
    <div id="resultsCarousel" class="carousel tappable-carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($lastResults as $index => $result) : ?>
                <li data-target="#resultsCarousel" data-slide-to="<?= $index; ?>" class="<?php if($firstResult->id == $result->id){ ?>active<?php } ?>"></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            foreach ($lastResults as $index => $result) : ?>
                <div class="item <?php if($firstResult->id == $result->id){ ?>active<?php } ?>">
                    <div class="carousel-caption">
                        <div class="mobile-container">
                            <div class="col-xs-6">
                                <div class="lottery-logo row">
                                    <a href="<?= $result->lottery->hasReviewPage() ? $result->lottery->reviewPage->pageContentByLanguage->fullUrl : 'javascript:;' ?>">
                                        <img src="<?= Yii::$app->imageManager->path($result->lottery->logoImage); ?>"
                                             alt="<?= $result->lottery->name; ?>">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-6 no-padding-mobile">
                                <div class="result-date row">
                                    <span date="<?=$result->getNativeDatetime()->format('d-m-Y');?>"><?= OldHelper::formatResultsData($result->getNativeDatetime())?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="result-numbers">
                                <?= \frontend\widgets\Numbers::widget(['lotteryResult' => $result]); ?>
                            </div>
                        </div>
                        <a class="mobile-single-link results-lottery-page" href="<?= $result->lottery->hasReviewPage() ? $result->lottery->reviewPage->pageContentByLanguage->fullUrl : 'javascript:;' ?>">
                            <span class="mobile-container">
                                <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review');?>
                                <span class="double-arrow"></span>
                            </span>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>