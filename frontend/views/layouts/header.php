<?php
\frontend\assets\AppAsset::register($this);
use common\models\records\SourceMessage;
use common\models\records\Page;
/* @var $this->params['currentPageContent'] \common\models\records\PageContent */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->pageData->pageContent->languageIso; ?>">
<head>
    <title><?= Yii::$app->pageData->pageContent->title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= Yii::$app->pageData->pageContent->description; ?>">
    <meta name="keywords" content="<?= mb_strtolower(Yii::$app->pageData->pageContent->keywords, 'UTF-8');?>">
    <meta name="viewport" content="width=device-width">
    <? foreach (Yii::$app->pageData->pageContent->page->pageContents as $value) : ?>
<!--        --><?// if(Auth::isAdmin(false) OR ($value['page_published'] && $value['language_published'])){ ?>
            <link rel="alternate" hreflang="<?=$value->languageIso;?>" href="http://<?=$_SERVER['HTTP_HOST'].$value->fullUrl;?>" />
<!--        --><?// } ?>
    <? endforeach; ?>

    <?php if(isset($canonical)) : ?>
        <link rel="canonical" href="http://<?= $_SERVER['HTTP_HOST'].$canonical; ?>"/>
    <?php endif; ?>
    <link rel="stylesheet" href="/public/css/se-pre-con.css">
<!--    --><?// if(!Auth::isAdmin(false)): ?>
<!--        <script>-->
<!--            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){-->
<!--                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),-->
<!--                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)-->
<!--            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');-->
<!---->
<!--            ga('create', 'UA-68624057-1', 'auto');-->
<!--            ga('send', 'pageview');-->
<!--        </script>-->
<!--    --><?// endif; ?>
</head>
<body class="container-fluid">
<?php $this->beginBody() ?>
<div class="se-pre-con"></div>
<header class="row">
    <div class="navbar-wrapper">
        <nav class="navbar navbar-default">
            <div class="navbar-header hidden-xs">
                <a class="nav-brand navbar-left" href="<?= Yii::$app->pageData->menuPages[Page::MODULE_HOME]->pageContentByLanguage->fullUrl; ?>">
                    <img src="/public/img/header-logo.svg" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'alt-for-logo-of-site');?>">
                </a>
            </div>
            <div class="collapse in navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right blue mobile-container">
                    <li class="hidden-xs"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_HOME]->pageContentByLanguage->fullUrl; ?>"><span class="h4"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Home Page');?></span></a></li>
                    <li class="hidden-xs"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_ABOUT_US]->pageContentByLanguage->fullUrl; ?>"><span class="h4"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'About Us');?></span></a></li>
                    <li class="hidden-xs"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_CONTACT_US]->pageContentByLanguage->fullUrl; ?>"><span class="h4"><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Contact Us');?></span></a></li>
                    <li class="dropdown languages-li">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle btn-languages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="hidden-xs">
                                    <img width="20px" src="<?= Yii::$app->imageManager->path(Yii::$app->pageData->pageContent->language->image,['width' => 20, 'height' => 20]);?>"
                                         alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'choose language');?>"
                                    />
                                    <?=Yii::t(SourceMessage::CATEGORY_GENERAL,'choose language');?> <span class="caret"></span>
                                </span>
                                <span class="visible-xs mobile-language-iso">
                                    <?= Yii::$app->pageData->pageContent->languageIso; ?>
                                    <span class="customized-caret"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                </span>
                            </button>
                            <ul id="languages" class="languages-dropdown dropdown-menu">
                                <?php foreach (Yii::$app->pageData->pageContent->page->pageContents as $pageContent) : ?>
                                    <li>
                                        <a href="<?=$pageContent->fullUrl;?>">
                                            <span class="language-menu-iso">
                                                <img width="20px" src="<?= Yii::$app->imageManager->path($pageContent->language->image,['width' => 20, 'height' => 20]);?>" alt="<?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$pageContent->language->name); ?>" />
                                            </span>
                                            <?=Yii::t(SourceMessage::CATEGORY_LANGUAGES,$pageContent->language->name);?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle btn-languages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="hidden-xs">
                                    <?=$_COOKIE['currencySymbol'];?> <?=Yii::t(SourceMessage::CATEGORY_CURRENCIES,$_COOKIE['selectedCurrency']);?><span class="caret"></span>
                                </span>
                                <span class="visible-xs mobile-currency">
                                    <?=$_COOKIE['currencySymbol'];?>
                                    <span class="customized-caret"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                </span>
                            </button>
                            <ul id="currencies" class="currencies-dropdown dropdown-menu">
                                <?php foreach (Yii::$app->pageData->currencies as $currency) : ?>
                                    <li class="<?= ($_COOKIE['selectedCurrency'] === $currency->name) ? 'active' : ''; ?> <?= $currency->published ? '' : 'visible-xs'; ?>">
                                        <a href="javascript:setCurrency('<?=$currency->costOneDollar;?>', '<?=$currency->name;?>', '<?=$currency->symbol;?>');">
                                            <span class="currency-menu-symbol"><?=$currency->symbol;?> </span>
                                            <?=Yii::t(SourceMessage::CATEGORY_CURRENCIES,$currency->name);?>
                                        </a>
                                    </li>
                                <? endforeach; ?>
                                <li class="hidden-xs"><a href="javascript:;" id="showAllCurrencies"><strong><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Show All Currencies');?></strong></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="longer-content-for-menu-over-logo"><div class="col-lg-12"></div></li>
                    <li><div class="col-lg-12"></div></li>
                </ul>
                <div class="nav-brand nav-brand-mobile visible-xs"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_HOME]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/header-logo.svg" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'alt-for-logo-of-site');?>"></a></div>
                <button type="button" class="toggle-menu-mobile visible-xs mobile-menu-row" data-toggle="collapse" data-target="#tools" aria-expanded="false">
                    <div id="toggle-cross" class="toggle-menu-button">
                        <i class="glyphicon glyphicon-menu-hamburger"></i>
                    </div>
                    <span class="menu-text"><?= Yii::t(SourceMessage::CATEGORY_GENERAL,'Menu'); ?></span>
                </button>
                <div id="tools" class="tools collapse">
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LOTTERIES_TABLE]->pageContentByLanguage->fullUrl;?>"><img src="/public/img/icon_lotto.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-lottories');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'lottories');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_BROKERS_TABLE]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_broker.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-brokers');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'brokers');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_LAST_RESULTS_TABLE]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_result.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-results');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'results');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_BUY_ONLINE_TABLE]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_buy.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-buy-online');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'buy online');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 hidden-xs col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_TOOLS_LIST]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_tools.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-tools');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'tools');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-4 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_ARTICLES_LIST]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_news.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-news');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'news');?></a></div>
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12 tool"><a href="<?= Yii::$app->pageData->menuPages[Page::MODULE_COMPARE_BROKERS]->pageContentByLanguage->fullUrl; ?>"><img src="/public/img/icon_compare.png" alt="<?=Yii::t(SourceMessage::CATEGORY_GENERAL,'top-menu-alt-compare-brokers');?>"><br><?=Yii::t(SourceMessage::CATEGORY_GENERAL,'Compare Brokers');?></a></div>
                </div>
            </div>
        </nav>
    </div>
    <?= isset($sliderBlock) ? $sliderBlock : '' ?>
</header>
