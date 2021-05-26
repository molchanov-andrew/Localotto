<?php

use yii\helpers\Html;

/** @author Andrew Molchanov andymolchanov@gmail.com
 * @var yii\web\View $this
 * @var common\models\records\PageContent $model
 * @var common\models\records\Image[] $images
 * @var common\models\records\Language[] $languages
 * @var common\models\records\Page $page
 * @var common\models\records\Banner[] $banners
 * @var common\models\records\Language[] $notUsedLanguages
 */

$this->title = 'Update Page Content: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Page Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'languageId' => $model->languageId, 'pageId' => $model->pageId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
        'languages' => $languages,
        'page' => $page,
        'notUsedLanguages' => $notUsedLanguages,
        'banners' => $banners,
    ]) ?>

</div>
