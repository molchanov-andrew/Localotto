<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\records\Lottery */
/* @var $countries common\models\records\Country */
/* @var $images common\models\records\Image */
/* @var $lotteries common\models\records\Lottery */

$this->title = 'Create Lottery';
$this->params['breadcrumbs'][] = ['label' => 'Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lottery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
        'lotteries' => $lotteries,
        'countries' => $countries,
    ]) ?>

</div>
