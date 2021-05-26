<?php

use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\grid\ActionColumn;
use backend\models\grid\CustomCheckboxColumn;
use common\models\records\PageContent;
use common\models\records\Page;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var backend\models\search\PageContentSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\records\Language[] $languages
 * @var Page $page
 */

$this->title = 'Page Contents';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(['id' => 'pjax']); ?>
    <!--    --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php if ($page !== null && !empty($page->getNotUsedLanguages())) : ?>
            <?= Html::a('Create Page Content', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
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
            'lastPageLabel' => 'Last'
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => CustomCheckboxColumn::class, 'limitFilter' => true],
            ['class' => SerialColumn::class],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function (PageContent $model, $key, $url) use ($page) {
                    $keyPair = http_build_query($key);
                    return Html::a($model->url, ($page === null) ? "/page/{$model->page->id}/page-content/update?{$keyPair}" : "/page/{$page->id}/page-content/update?{$keyPair}");
                }
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['class' => 'column-300'],
                'filterOptions' => ['class' => 'column-300'],
                'contentOptions' => ['class' => 'column-300'],
            ],
            [
                'attribute' => 'pageModule',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'module',
                    Page::MODULES,
                    ['class' => 'form-control', 'prompt' => 'Select module']),
                'value' => function (PageContent $model) {
                    return $model->page->moduleName;
                }
            ],
            [
                'attribute' => 'Language',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'languageName',
                    ArrayHelper::map($languages, 'name', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Select Language']),
                'value' => function (PageContent $model) {
                    return $model->language->name;
                }
            ],
//            'updated',
            //'imageId',

            //'pageId',
            [
                'attribute' => 'published',
                'filter' => Html::activeDropDownList($searchModel, 'published', ['0', '1'],
                    ['class' => 'form-control', 'prompt' => 'Select status']),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model, $key, $index) use ($page) {
                    /** @var PageContent $model */
                    $keyPair = http_build_query($key);
                    return $page === null ? "/page/{$model->page->id}/page-content/{$action}?{$keyPair}" : "/page/{$page->id}/page-content/{$action}?{$keyPair}";
                },
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
