<?php
use common\models\records\SourceMessage;
/* @var \common\models\records\LotteryResult $result */
?>
<?php if($result->mainNumbers != '') : ?>
    <div class="inline-numbers">
        <?php foreach (explode(',', $result->mainNumbers) as $value) :
            if(is_numeric($value)) : ?>
                <span class="main-lottery-number"><?=$value;?></span>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($result->additionalNumbers != ''):?>
            <?php foreach (explode(',', $result->additionalNumbers) as $value) :
                if(is_numeric($value)) : ?>
                    <span class="secondary-lottery-number"><?=$value;?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif;?>

        <?php if($result->bonusNumbers != ''): ?>
            <?php foreach (explode(',', $result->bonusNumbers) as $value) :
                if(is_numeric($value)): ?>
                    <span class="bonus-lottery-number"><?=$value;?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif;?>
    </div>
<?php else : ?>
    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Coming soon');?>
<?php endif; ?>