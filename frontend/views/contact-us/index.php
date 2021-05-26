<?php
    use \common\models\records\SourceMessage;
?>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12 mobile-contained-row">
        <?= Yii::$app->pageData->pageContent->content1; ?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<section class="row">
    <div class="col-lg-2 col-md-1 hidden-xs hidden-sm"></div>
    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 mobile-contained-row">
        <form id="contactForm" name="contact-form">
            <p>
                <input class="form-control" id="name" name="full_name" onblur="" onfocus="" value="" placeholder="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Full Name');?>*" onkeyup="this.setAttribute('value', this.value);" type="text"></p>
            <p>
                <input class="form-control" id="email" name="email" onblur="" onfocus="" value="" placeholder="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Email');?>*" onkeyup="this.setAttribute('value', this.value);" type="text"></p>
            <p>
                <input class="form-control" id="phone" name="phone" onblur="" onfocus="" value="" placeholder="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Phone');?>*" onkeyup="this.setAttribute('value', this.value);" type="text"></p>
            <p>
                <textarea class="form-control" id="message" name="message" onblur="" onfocus="" rows="10" data-value="" onkeyup="this.setAttribute('data-value', this.value);"></textarea></p>
            <center>
                <h3 class="cancel-mobile-container">
                    <button type="button" class="btn btn-lg btn-primary" id="sendContactFormFromCU"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Send Contact Form');?></button>
                </h3>
            </center>
        </form>
    </div>
    <div class="col-lg-2 col-md-1 hidden-xs hidden-sm"></div>
</section>
<section class="row">
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
    <article class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        <?= Yii::$app->pageData->pageContent->content2; ?>
    </article>
    <div class="col-lg-1 hidden-xs hidden-sm hidden-md"></div>
</section>
<div class="modal fade" id="popUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <div class="modal-content">

            <div class="modal-body">
            </div>
        </div>
    </div>
</div>