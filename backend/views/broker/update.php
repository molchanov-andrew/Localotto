<?php

use yii\helpers\Html;

/* @var $model common\models\records\Broker */
/* @var $images common\models\records\Image */
/* @var $statuses common\models\records\BrokerStatus */
/* @var $bonuses  common\models\records\Bonus */
/* @var $languages common\models\records\Language */
/* @var $paymentMethods common\models\records\PaymentMethod */

$this->title = 'Update Broker: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brokers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="broker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
        'statuses' => $statuses,
        'bonuses' => $bonuses,
        'languages' => $languages,
        'paymentMethods' => $paymentMethods,
    ]) ?>

</div>
