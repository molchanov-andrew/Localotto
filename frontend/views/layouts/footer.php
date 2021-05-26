<?php
    use common\models\records\SourceMessage;
    use common\models\records\Page;
?>
<footer class="row">
    <div class="col-lg-8 col-md-8 col-xs-12 center-div">
        <div class="row">
            <div class="col-lg-5">
                <p class="hidden-xs security-text"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Security');?>:</p>
                <img class="footer-logo" src="/public/img/footer-logo.svg" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Security');?>">
            </div>
            <div class="col-lg-7 footer-menu">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 no-padding-mobile">
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_HOME]->pageContentByLanguage->fullUrl; ?>"><span class="mobile-container"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Home Page');?></span></a><br>
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_ABOUT_US]->pageContentByLanguage->fullUrl; ?>"><span class="mobile-container"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'About Us');?></span></a><br>
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_CONTACT_US]->pageContentByLanguage->fullUrl; ?>"><span class="mobile-container"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Contact Us');?></span></a>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6 hidden-xs">
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LAST_RESULTS_TABLE]->pageContentByLanguage->fullUrl; ?>"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'results');?></a><br>
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_BUY_ONLINE_TABLE]->pageContentByLanguage->fullUrl; ?>"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'buy online');?></a><br>
                                <a class="h4" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_ARTICLES_LIST]->pageContentByLanguage->fullUrl; ?>"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'news');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->params['mobileWrapTemplate']; ?>
    <div class="col-lg-12 col-md-12 col-xs-12 copyright">
        <center><p>Lottery Playing © <?=date('Y');?></p></center>
    </div>

    <?= isset($popupBlock) ? $popupBlock : ''; ?>
    <?= isset($mobileCollapsibleBlock) ? $mobileCollapsibleBlock : ''; ?>
</footer>
<span class="glyphicon glyphicon-arrow-up" id="toTop"></span>
<link rel="stylesheet" href="/public/js/bootstrap-3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/public/css/bootstrap-table.min.css">
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/style.css" />
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/responsive.css" />
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/votes.css" />
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/circles.css" />
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/responsiveTo768.css?v=1">
<link rel="stylesheet" type="text/css" href="/public/css/new_styles/responsiveTo992.css">
<script type="text/javascript">
    var language = "<?= Yii::$app->pageData->pageContent->languageIso; ?>";
    var languageId = "<?= Yii::$app->pageData->pageContent->language->id; ?>";
    var TranslatorJS = {
        billion:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'billion'));?>',
        million: '<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'million'));?>',
        thousands:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'thousands'));?>',
        days:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'days'));?>',
        day:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'day'));?>',
        ShowAll:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'View All'));?>',
        Hidden:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'Hidden'));?>',
        underwayDraw:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'The draw is underway'));?>',
        billionsIndex:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'billionsIndex'));?>',
        millionsIndex:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'millionsIndex'));?>',
        thousandsIndex:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'thousandsIndex'));?>',
        day1:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'day1'));?>',
        day2:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'day2'));?>',
        day5:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'day5'));?>',
        hour1:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'hour1'));?>',
        hour2:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'hour2'));?>',
        hour5:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'hour5'));?>',
        minute1:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'minute1'));?>',
        minute2:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'minute2'));?>',
        minute5:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'minute5'));?>',
        second1:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'second1'));?>',
        second2:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'second2'));?>',
        second5:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'second5'));?>',
        noResultsText:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'no_results_text'));?>',
        zeroPriceText:'<?=addslashes(Yii::t(SourceMessage::CATEGORY_GENERAL,'zero_price_text'));?>',
        messageEmailEmpty:"<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'This field is empty.'); ?>",
        messageIncorrectEmail:"<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Incorrect Email.'); ?>" + "<br>" + "<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Example');?>: emailName@gmail.com",
        messageRate:"<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Rate agent.'); ?>",
        emptyJackpot:"<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'empty_jackpot'); ?>"
    };
    currencies = {
    <?php foreach (Yii::$app->pageData->currencies as $currency): ?>
    <?= $currency->id; ?>:{
        symbol:"<?= $currency->symbol; ?>",
            rate:"<?= $currency->costOneDollar; ?>",
            name:"<?= $currency->name; ?>"
    },
    <?php endforeach; ?>
    }
</script>
<!--<script src="/public/js/cloud/jquery.cookie.min.js"></script>-->
<!--<script src="/public/js/bootstrap-3.3.7/js/bootstrap.min.js"></script>-->
<!--<script src="/public/js/cloud/bootstrap-table.min.js"></script>-->
<!--<script src="/public/js/jquery-mobile/jquery.mobile.custom.min.js"></script>-->
<!--<script src="/public/js/responsive_changes.js"></script>-->
<!--<link rel="stylesheet" href="/public/js/jquery-mobile/jquery.mobile-1.4.5.min.css">-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<!--<script src="/public/js/cloud/bootstrap-select.min.js"></script>-->
<!--<script src="/public/js/javascript.js?v=2" type="text/javascript" ></script>-->
<!--<script src="/public/js/popup.js"></script>-->
<!--<script src="/public/js/cloud/modernizr.js"></script>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>