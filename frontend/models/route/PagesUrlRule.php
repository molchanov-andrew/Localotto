<?php

namespace frontend\models\route;

use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\PageContent;
use Yii;
use yii\base\BaseObject;
use yii\db\ActiveQuery;
use yii\web\UrlRuleInterface;

class PagesUrlRule extends BaseObject implements UrlRuleInterface
{

    /**
     * Parses the given request and returns the corresponding route and parameters.
     * @param \yii\web\UrlManager $manager the URL manager
     * @param \yii\web\Request $request the request component
     * @return array|bool the parsing result. The route and the parameters are returned as an array.
     * If false, it means this rule cannot be used to parse this path info.
     */
    public function parseRequest($manager, $request)
    {

        $pathInfo = $request->getPathInfo();

        if (!empty($pathInfo) && is_string($pathInfo) && strpos('/', $pathInfo) === 0) {
            $pathInfo = substr($pathInfo, 1);
        }

        $foundPageContent = PageContent::find()->published()->url($pathInfo)->with(['page' => function (PageQuery $query) {
            return $query->with(['pageContents' => function (PageContentQuery $query) {
                return $query->published()->with(['language' => function (ActiveQuery $query) {
                    return $query->with('image');
                }]);
            }]);
        }, 'language', 'banners'])->one();
        /** @var PageContent $foundPageContent */
        if (null === $foundPageContent) {
            return false;
        }
        Yii::$app->pageData->setCurrentLanguage($foundPageContent->language);
        Yii::$app->language = $foundPageContent->language->iso;

        $route = $foundPageContent->page->module . '/index';
        Yii::$app->pageData->setPageContent($foundPageContent);
/*        echo "<pre>";
        print_r($route);
        echo "</pre>";
        die;*/
        /*echo "<pre>";
        print_r($foundPageContent->content);
        echo "</pre>";
        die;*/
        return [$route, ['currentPageContent' => $foundPageContent]];
    }

    /**
     * Creates a URL according to the given route and parameters.
     * @param \yii\web\UrlManager $manager the URL manager
     * @param string $route the route. It should not have slashes at the beginning or the end.
     * @param array $params the parameters
     * @return string|bool the created URL, or false if this rule cannot be used for creating this URL.
     */
    public function createUrl($manager, $route, $params)
    {
        return $route;
    }
}