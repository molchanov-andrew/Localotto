<?php

use backend\models\grid\CustomCheckboxColumn;
use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use backend\models\image\RelativeImageColumn;
use common\models\records\Banner;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Banner', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Change multiple', ['change-multiple'], [
            'class' => 'btn btn-primary change-multiple-grid open-modal-link',
            'data-toggle' => 'modal',
            'data-target' => '#modalGeneral',
            'data-pjax' => '0',
        ]); ?>
        <?= Html::a('Delete', ['delete-multiple'], ['class' => 'btn btn-danger ajax-solo-rows',
            'data-solo-confirm' => Yii::t('yii', 'Are you sure you want to delete this items?'),]) ?>
    </p>

    <?= GridView::widget([
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel' => 'Last',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => CustomCheckboxColumn::class, 'limitFilter' => true],
            ['class' => SerialColumn::class],
            [
                'attribute' => 'link',
                'format' => 'url',
                'headerOptions' => ['class' => 'column-200',],
                'filterOptions' => ['class' => 'column-200',],
                'contentOptions' => ['class' => 'column-200',],
            ],
            [
                'attribute' => 'position',
                'filter' => Html::activeDropDownList($searchModel, 'position',
                    Banner::getPositionList(),
                    ['class' => 'form-control', 'prompt' => 'Select format']),
                'value' => function (Banner $model) {
                    return $model->positionName;
                }
            ],
            [
                'class' => RelativeImageColumn::class,
                'imageField' => 'image',
            ],

            ['class' => ActionColumn::class],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
