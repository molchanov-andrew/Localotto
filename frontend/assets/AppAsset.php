<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\bootstrap\BootstrapAsset;
use yii\web\YiiAsset;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
    ];
    public $js = [
        'public/js/cloud/jquery.cookie.min.js',
        'public/js/bootstrap-3.3.7/js/bootstrap.min.js',
        'public/js/cloud/bootstrap-table.min.js',
        'public/js/jquery-mobile/jquery.mobile.custom.min.js',
        'public/js/responsive_changes.js',
        'public/js/cloud/bootstrap-select.min.js',
        'public/js/javascript.js',
        'public/js/popup.js',
        'public/js/cloud/modernizr.js',
    ];
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
    ];
}
