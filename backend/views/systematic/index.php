<?php

use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\grid\CustomCheckboxColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SystematicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Systematics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="systematic-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Systematic', ['create'], ['class' => 'btn btn-success']) ?>
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

            'numbers',
            'lines',
            'updated',

            ['class' => ActionColumn::class],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
