<?php

use yii\helpers\Html;


/* @var yii\web\View $this */
/* @var common\models\records\BrokerToLottery $model */
/* @var common\models\records\Broker[] $brokers */
/* @var common\models\records\Lottery[] $lotteries */
/* @var common\models\records\Lottery $parentModel */

$this->title = "Create {$parentModel->name} relation";
$this->params['breadcrumbs'][] = ['label' => 'Broker To Lotteries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="broker-to-lottery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'brokers' => $brokers,
        'lotteries' => $lotteries,
        'parentModel' => $parentModel,
    ]) ?>

</div>
