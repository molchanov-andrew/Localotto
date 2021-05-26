<?php
/* @var \common\models\records\Currency[] $currencies */
?>
<?php foreach ($currencies as $value) : ?>
    <li><a href="javascript:;" onclick="setCurrency('<?=$value->costOneDollar;?>', '<?=$value->name;?>','<?=$value->symbol;?>');"><?=$value->symbol;?> <?=Yii::t(\common\models\records\SourceMessage::CATEGORY_CURRENCIES,$value->name);?></a></li>
<?php endforeach; ?>