<?php

use backend\widgets\image\Select2Image;
use yii\helpers\Html;
use backend\models\widgets\bootstrap\ActiveForm;
use backend\widgets\froala\editor\src\FroalaEditorWidget;
use kartik\select2\Select2;
use backend\widgets\image\Select2Banner;
use yii\helpers\ArrayHelper;

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

if (!isset($isModal)) {
    $isModal = false;
}
?>

<div class="page-content-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if ($isModal) : ?>
    <div class="modal-body"> <?php endif; ?>
        <div class="row">
            <div class="col-sm-6">
                <h3>Main data</h3>
                <!--<div class="form-group field-pagecontent-url">
                    <label class="control-label" for="#pagecontent-url">Url</label>
                    <div class="input-group">
                        <div class="input-group-addon">/</div>
                        <? /*= $form->field($model, 'url', ['options' => ['tag' => null,
                            'class' => 'form-control',
                            'id' => 'pagecontent-url',]])->textInput(['maxlength' => true,])->label(false) */ ?>
                    </div>
                </div>-->
                <?php if (!$isModal) : ?>
                    <?= $form->field($model, 'url',
                        [
                            'template' => "{label}\n<div id=\"pagecontent-url\" style=\"display: flex;\"><div class=\"input-group-addon\">/</div>{input}</div>\n{error}",
                        ])->textInput(['maxlength' => true])->label('Url') ?>
                <?php endif; ?>

                <?= $form->field($model, 'published')->checkbox() ?>
                <?php if (!$isModal) : ?>
                    <?= $form->field($model, 'languageId')->widget(Select2::class, [
                        'data' => array_column($notUsedLanguages, 'name', 'id'),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => [
                            'prompt' => 'None',
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                <?php endif; ?>
                <?= $form->field($model, 'pageId')->hiddenInput()->label(false) ?>
                <?php if (!$isModal) : ?>
                    <h3>SEO data</h3>

                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

                    <h3>Other data</h3>

                    <?= $form->field($model, 'additionalDescription')->textarea(['rows' => 2]) ?>

                    <?= $form->field($model, 'alternativeDescription')->textarea(['rows' => 2]) ?>

                    <?= $form->field($model, 'imageId')->widget(Select2Image::class, [
                        'data' => $images,
                        'theme' => Select2Image::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>
            <div class="col-sm-6">
                <?php if (!$isModal) : ?>
                    <?= $form->field($model, 'serviceContent1')->widget(FroalaEditorWidget::class, [
                        'options' => [
                            'class' => 'froala-text-editor',
                        ],
                        'clientOptions' => Yii::$app->params['froalaOptions']
                    ])->label('Content 1') ?>
                    <?= $form->field($model, 'serviceContent2')->widget(FroalaEditorWidget::class, [
                        'options' => [
                            'class' => 'froala-text-editor',
                        ],
                        'clientOptions' => Yii::$app->params['froalaOptions']
                    ])->label('Content 2') ?>

                    <?= $form->field($model, 'rightTopBanner')->widget(Select2Banner::class, [
                        'name' => "PageContent[banners]['right_top']",
                        'data' => ArrayHelper::getValue($banners, 'right_top'),
                        'value' => $model->banners[0]->id ?? null,
                        'theme' => Select2Image::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => 'Select banner',
                        ],
                    ])->label('RightTopBanner') ?>

                    <?= $form->field($model, 'rightBottomBanner')->widget(Select2Banner::class, [
                        'name' => "PageContent[banners]['right_bottom']",
                        'data' => ArrayHelper::getValue($banners, 'right_bottom'),
                        'value' => $model->banners['right_bottom']->id ?? null,
                        'theme' => Select2Image::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => 'Select banner',
                        ],
                    ])->label('RightBottomBanner') ?>

                    <?= $form->field($model, 'bottomBanner')->widget(Select2Banner::class, [
                        'name' => "PageContent[banners]['bottom']",
                        'data' => ArrayHelper::getValue($banners, 'bottom'),
                        'value' => $model->banners[1]->id ?? null,
                        'theme' => Select2Image::THEME_BOOTSTRAP,
                        'pluginOptions' => [
                            'allowClear' => true,
                            'placeholder' => 'Select banner',
                        ],
                    ])->label('BottomBanner') ?>
                <?php endif; ?>
            </div>
        </div>


        <?php if ($isModal) : ?> </div>
    <div class="modal-footer">
        <?php echo Html::submitButton('Change', [
            'class' => 'btn btn-success',
            'title' => 'Change timer',
        ]) ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
<?php else: ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    $(document).ready(function(){
        $('#pagecontent-url').keyup(function () {
            $(this).val(removeSlashInBeginning($(this).val()));
            })
    });
$('.select2-pagecontent-righttopbanner-container').one('click', function(){
    console.log($(this).parent().attr('id'));
$("#pagecontent-righttopbanner option[value='']").attr('selected', true);
})
    function removeSlashInBeginning(s) {
        return (s.length && s[0] == '/') ? s.slice(1) : s;
    }
JS;
$this->registerJs($script);
?>
