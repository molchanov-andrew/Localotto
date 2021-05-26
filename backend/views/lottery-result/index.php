<?php

use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use common\models\records\LotteryResult;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\grid\CustomCheckboxColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LotteryResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $lottery \common\models\records\Lottery */

$this->title = 'Lottery Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lottery-result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Lottery Result', ["lottery/{$lottery->id}/lottery-result/create"], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Change multiple', [Url::base()], ['class' => 'btn btn-primary', 'id' => 'multiple-change']) ?>
        <?= Html::a('Delete multiple', [Url::base()], [
            'id' => 'multiple-delete',
            'class' => 'btn btn-danger',
            'data-solo-confirm' => Yii::t('yii', 'Are you sure you want to delete this items?'),
        ]) ?>
    </p>

    <?= GridView::widget([
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => CustomCheckboxColumn::class, 'limitFilter' => true],
            ['class' => SerialColumn::class],

            'id',
            'uniqueResultId',
            [
                'attribute' => 'mainNumbers',
                'label' => 'Numbers',
                'value' => function(LotteryResult $model){
                    return $model->getNumbersString();
                }
            ],
            [
                'attribute' => 'date',
                'label' => 'Date(by timezone of lottery)',
                'format' => 'raw',
                'value' => function(LotteryResult $model){
                    return $model->getNativeDatetime()->format('d-m-Y H:i:s');
                }
            ],
            //'status',
            //'jackpot',
            //'created',
            //'updated',
            //'lotteryId',
            //'lotteryTimerId:datetime',

            ['class' => ActionColumn::class],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
