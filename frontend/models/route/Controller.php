<?php /** @noinspection ALL */

namespace frontend\models\route;

use frontend\helpers\OldHelper;
use frontend\models\CountryReceiver;
use common\models\records\Country;
use common\models\records\Language;
use Yii;

class Controller extends \yii\web\Controller
{
    const DEFAULT_CACHE_DURATION = 60;

    public function init()
    {
        $currentPageContent = Yii::$app->request->get('currentPageContent',null);
        $languages = Language::find()->andWhere(['published' => 1])->all();
        $this->view->params['mobileWrapTemplate'] = $this->_renderMobileCollapsibleBlock();

        self::_setupDefaultCookies();

        parent::init();
    }

    protected function _renderRightBannerBlock()
    {
        return $this->renderPartial('@app/views/ui/right-banners');
    }

    protected function _renderMobileCollapsibleBlock()
    {
        return $this->renderPartial('@app/views/ui/mobile-wrap-template');
    }

    private static function _setupDefaultCookies()
    {
        if (!isset($_COOKIE['currency']) || !isset($_COOKIE['currencySymbol'])) {
            if($countryISO = CountryReceiver::getByRemoteAddress()) { // If got country by ip address.
                $currentCountry = Country::find()->andWhere(['iso' => $countryISO])->with('currency')->one();
                setcookie('country',$countryISO, time() + (86400 * 30), "/");
                $_COOKIE['country'] = $countryISO;
                // If we have such country.
                if(isset($_COOKIE['country']) && $currentCountry instanceof Country && $currentCountry->currency !== null) {
                    $_COOKIE['currency'] = $currentCountry->currency->costOneDollar;
                    $_COOKIE['selectedCurrency'] = $currentCountry->currency->name;
                    $_COOKIE['currencySymbol'] = $currentCountry->currency->symbol;
                    setcookie('currency',$currentCountry->currency->costOneDollar, time() + (86400 * 30), "/");
                    setcookie('selectedCurrency',$currentCountry->currency->name, time() + (86400 * 30), "/");
                    setcookie('currencySymbol', $currentCountry->currency->symbol, time() + (86400 * 30), "/");
                    return;
                }
            }
            self::_defaultCookies();

        }
        return;
    }

    private static function _defaultCookies()
    {
        $_COOKIE['currency'] = 1;
        $_COOKIE['selectedCurrency'] = 'Dollar';
        $_COOKIE['currencySymbol'] = '$';
        setcookie('currency',1, time() + (86400 * 30), "/");
        setcookie('currencySymbol','$', time() + (86400 * 30), "/");
        setcookie('selectedCurrency', 'Dollar', time() + (86400 * 30), "/");
    }

    protected function _renderLotteryHead($lottery)
    {
        return $this->renderPartial('@app/views/ui/lottery-head',['lottery' => $lottery]);
    }

    protected function _setDynamicTags()
    {

    }
}