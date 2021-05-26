<?php
use \common\models\records\SourceMessage;
use \common\models\records\Page;
/* @var \common\models\records\Broker[] $brokers */
?>
<?php $firstBroker = reset($brokers); ?>
<div class="agents-carousel-container hidden-sm hidden-md hidden-lg row">
    <div id="agentsCarousel" class="carousel tappable-carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php foreach ($brokers as $index => $broker) : ?>
                <li data-target="#resultsCarousel" data-slide-to="<?= $index; ?>" class="<?php if($firstBroker->id == $broker->id){ ?>active<?php } ?>"></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            foreach ($brokers as $index => $broker) : ?>
                <div class="item <?php if($firstBroker->id == $broker->id){ ?>active<?php } ?>">
                    <div class="carousel-caption">
                        <div class="broker-logo">
                            <a href="<? if ($broker->hasReviewPage()) {
                                echo $broker->reviewPage->pageContentByLanguage->fullUrl;
                            } else {
                                echo 'javascript:;';
                            } ?>">
                                <img alt="<?=$broker->name;?>" src='<?= Yii::$app->imageManager->path($broker->image); ?>' />
                            </a>
                            <?php if($broker->status->mainPageImage !== null) : ?>
                                <div style="background-image: url('<?= Yii::$app->imageManager->path($broker->status->mainPageImage) ?>');" class="broker-label"></div>
                            <?php endif; ?>
                        </div>
                        <div class="broker-description mobile-container">
                            <?php if($broker->hasReviewPage()) : ?>
                                <?=$broker->reviewPage->pageContentByLanguage->additionalDescription;?>
                            <?php endif; ?>
                        </div>
                        <div class="count-lotteries mobile-container">
                            <span class="word"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Lottories');?>: </span>
                            <span class="number"><?=count($broker->brokerToLotteries);?></span>
                        </div>
                        <?php if(!empty($broker->site)) : ?>
                            <a class="mobile-single-link to-agent-site" href="<?= $broker->site; ?>" rel="nofollow">
                                <span class="mobile-container">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Go to');?> <?=$broker->name;?>
                                    <span class="double-arrow double-arrow-green"></span>
                                </span>
                            </a>
                        <?php endif; ?>
                        <?php if($broker->hasReviewPage()) : ?>
                            <a class="mobile-single-link read-agent-review" href="<?= $broker->reviewPage->pageContentByLanguage->fullUrl; ?>">
                                <span class="mobile-container">
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Read Full Review');?>
                                    <span class="double-arrow"></span>
                                </span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <a class="mobile-single-link agents-page" href="<?=Yii::$app->pageData->menuPages[Page::MODULE_BROKERS_TABLE]->pageContentByLanguage->fullUrl;?>">
        <span class="mobile-container">
            <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'View All Agents');?>
            <span class="double-arrow"></span>
        </span>
    </a>
</div>