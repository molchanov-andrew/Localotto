<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\records\Broker */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brokers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="broker-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'published',
            'name',
            'site',
            'year',
            'clicks',
            'minimalDeposit',
            'disableIframe',
            'systematic',
            'syndicat',
            'scanTicket',
            'chat',
            'security',
            'support',
            'gameplay',
            'promotions',
            'withdrawals',
            'usability',
            'gameSelection',
            'discounts',
            'marks',
            'summaryMarks',
            [
                'label' => 'Languages',
                'format' => 'raw',
                'value' => function ($model) {
                    $result = [];
                    foreach ($model->languages as $language) {
                        $result[] = Html::tag('p', $language->name);
                    }
                    return implode('', $result);
                }
            ],
            [
                'label' => 'Payments Methods',
                'format' => 'raw',
                'value' => function ($model) {
                    $result = [];
                    foreach ($model->paymentMethods as $method) {
                        $result[] = Html::tag('p', $method->name);
                    }
                    return implode('', $result);
                }
            ],
            [
                'label' => 'Bonuses',
                'format' => 'raw',
                'value' => function ($model) {
                    $result = [];
                    foreach ($model->bonuses as $bonus) {
                        $result[] = Html::tag('p', $bonus->name);
                    }
                    return implode('', $result);
                }
            ],
            'created',
            'updated',
            'statusId',
            [
                'format' => ['image', ['width' => '100px']],
                'label' => 'Logo Image',
                'value' => Yii::$app->params['frontendUrl'] . $model->getImage()->one()->getFilePath()
            ],
        ]
    ]) ?>

</div>
