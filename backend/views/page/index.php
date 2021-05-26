<?php

use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use common\models\records\Page;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\grid\CustomCheckboxColumn;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $languages*/

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
<!--        --><?//= Html::a('Change multiple', [Url::base()], ['class' => 'btn btn-primary', 'id' => 'multiple-change']) ?>
        <?= Html::a('Delete multiple', [Url::base()], [
            'id' => 'multiple-delete',
            'class' => 'btn btn-danger',
            'data-solo-confirm' => Yii::t('yii', 'Are you sure you want to delete this items?'),
        ]) ?>
    </p>
    <p>
        <?= Html::a('View all page contents', ['/page-content/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'pager' => [
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{errors}\n{summary}\n{pager}\n{items}\n{summary}\n{pager}",
        'columns' => [
            ['class' => CustomCheckboxColumn::class, 'limitFilter' => true],
            ['class' => SerialColumn::class],
            'name',
            [
                'attribute' => 'module',
                'filter' => Html::activeDropDownList($searchModel, 'module',
                    Page::MODULES,
                    ['class' => 'form-control', 'prompt' => 'Select module']),
                'value' => function (Page $model) {
                    return $model->moduleName;
                }
            ],
            [
                'attribute' => 'Related',
                'format' => 'raw',
                'value' => function (Page $model) {
                    switch ($model->module) {
                        case Page::MODULE_BUY_LOTTERY:
                        case Page::MODULE_LOTTERY:
                        {
                            return $model->lottery !== null ? Html::a($model->lottery->name, ['lottery/view', 'id' => $model->lottery->id]) : 'Not set';
                            break;
                        }
                        case Page::MODULE_BROKER:
                        {
                            return $model->broker !== null ? Html::a($model->broker->name, ['broker/view', 'id' => $model->broker->id]) : 'Not set';
                            break;
                        }
                        case Page::MODULE_RESULTS_BY_COUNTRY:
                        {
                            return $model->country !== null ? Html::a($model->country->name, ['country/view', 'id' => $model->country->id]) : 'Not set';
                            break;
                        }
                        default:
                        {
                            return 'none';
                            break;
                        }
                    }

                }
            ],
            [
                'attribute' => 'Page contents',
                'format' => 'raw',
                'value' => function (Page $model) {
                    if (empty($model->pageContents)) {
                        return 'Not Set.' . Html::a('Create', ["/page/{$model->id}/page-content/create"]);
                    }
                    return implode(', ', array_map(function (\common\models\records\PageContent $pageContent) use ($model) {
                        return Html::a($pageContent->language->iso, ["/page/{$model->id}/page-content/update", 'languageId' => $pageContent->languageId, 'pageId' => $pageContent->pageId]);
                    }, $model->pageContents));
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{page-contents} {view} {update} {delete}',
                'buttons' => [
                    'page-contents' => function ($url, Page $model) {
                        return Html::a('<i class="glyphicon glyphicon-list-alt"></i>', ['/page/' . $model->id . '/page-content/index'], [
                            'class' => 'actions-button',
                            'title' => 'Page contents list',
                            'data-pjax' => '0',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>