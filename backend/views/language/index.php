<?php

use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\grid\CustomCheckboxColumn;
use backend\models\image\RelativeImageColumn;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Languages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Language', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Change multiple',['change-multiple'],[
            'class' => 'btn btn-primary change-multiple-grid open-modal-link',
            'data-toggle'=>'modal',
            'data-target'=>'#modalGeneral',
            'data-pjax' => '0',
        ]); ?>
        <?= Html::a('Delete multiple', ['delete-multiple'], ['class' => 'btn btn-danger ajax-solo-rows',
            'data-solo-confirm' => Yii::t('yii', 'Are you sure you want to delete this items?'),]) ?>
    </p>

    <?= GridView::widget([
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => CustomCheckboxColumn::class, 'limitFilter' => true],
            ['class' => SerialColumn::class],

            'iso',
            'name',
            'published:boolean',
            'translatable:boolean',
            'updated',
            [
                'class' => RelativeImageColumn::class,
                'imageField' => 'image',
            ],

            ['class' => ActionColumn::class],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
