<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @author Andrew Molchanov andymolchanov@gmail.com
 * @var yii\web\View $this
 * @var \common\models\records\PageContent $model
 * @var \common\models\records\Image[] $images
 * @var \common\models\records\Language[] $languages
 * @var  \common\models\records\Page $page
 * @var \common\models\records\Banner[] $banners
 * @var \common\models\records\Language[] $notUsedLanguages
 * @var boolean $isModal
 */
?>
    <div class="change-multiple-modal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change multiple <?= $model->tableName() ?></h4>
        </div>
        <?= $this->render('_form', [
            'model' => $model,
            'images' => $images,
            'languages' => $languages,
            'page' => $page,
            'banners' => $banners,
            'notUsedLanguages' => $notUsedLanguages,
            'isModal' => true,
        ]) ?>
    </div>
<?php $this->registerCssFile('@web/css/gridChangeMultiple.css'); ?>
