<?php
/**
 * Date: 8/18/18
 */

namespace frontend\helpers;

use common\models\records\SourceMessage;
use frontend\helpers\OldHelper as Helper;
use DateTime;
use Yii;

class DynamicContentHelper
{

    public static function getDifferenceYearAndDate($string, $params)
    {
        $pattern = '/\[date_counter\|([0-9]{4}|[0-9]{2}\/[0-9]{2}\/[0-9]{4})\]/';
        $template = $params['template'] ?? 'dateCounterString';
        $language = strtolower(Yii::$app->language);

        return preg_replace_callback($pattern,function ($matches) use ($template, $language) {
            $date = $matches[1];
            $date = trim($date);

            // It's only year
            if(strlen($date) == 4) {
                $dateTime = DateTime::createFromFormat('d/m/Y','01/01/'.$date);
            }
            // It's date
            elseif(strlen($date) == 10){
                $dateTime = DateTime::createFromFormat('d/m/Y',$date);
            }
            else{
                $dateTime = new DateTime();
            }
            $dDiff = Helper::getDateTimeDiffFromNow($dateTime);

            return Helper::replaceContentTags([
                '[days]' => $dDiff->d,
                '[months]' => $dDiff->m,
                '[years]' => $dDiff->y,
                '[daysWord]' => Yii::t(SourceMessage::CATEGORY_GENERAL, Helper::numberToWord($dDiff->d, ['day1','day2','day5'], $language)),
                '[monthsWord]' => Yii::t(SourceMessage::CATEGORY_GENERAL, Helper::numberToWord($dDiff->d, ['month1','month2','month5'], $language)),
                '[yearsWord]' => Yii::t(SourceMessage::CATEGORY_GENERAL, Helper::numberToWord($dDiff->d, ['year1','year2','year5'], $language)),
            ], Yii::t(SourceMessage::CATEGORY_GENERAL, $template));
        },$string);
    }

    public static function chooseCurrency($string,$params = []){
        $pattern = '/\[choose_currency\|([0-9\.]{0,40}),([A-Z]{3})\]/';

        $result = preg_replace_callback($pattern,function ($matches) use ($params) {
            $template = '<span class="ticket-price counter money" data-special-currency-id="%d">%F</span>';
            $amount = $matches[1];
            $currencyIso = $matches[2];
            if($currencyIso === 'USD'){
                $currencyIso = 'Dollar';
            }

            $foundCurrency = array_filter($params['currencies'],function($value) use ($currencyIso){
                return $currencyIso == $value['default'];
            });
            if(!empty($foundCurrency)){
                $foundCurrency = reset($foundCurrency);
            } else {
                return false;
            }
            $dollarAmount = (float)$amount / (float)$foundCurrency['cost_one_dollar'];
            return sprintf($template,$foundCurrency['id'],$dollarAmount);

        },$string);

        return $result;
    }
    public static function money($string,$params = []){
        $pattern = '/\[money\|([0-9\.]{0,40}),([A-Z]{3})\]/';

        $result = preg_replace_callback($pattern,function ($matches) use ($params) {
            $template = '<span class="money money-dynamic">%F</span>';
            $amount = $matches[1];
            $currencyIso = $matches[2];
            if($currencyIso === 'USD'){
                $currencyIso = 'Dollar';
            }

            $foundCurrency = array_filter($params['currencies'],function($value) use ($currencyIso){
                return $currencyIso == $value['default'];
            });
            if(!empty($foundCurrency)){
                $foundCurrency = reset($foundCurrency);
            } else {
                return false;
            }
            $dollarAmount = (float)$amount / (float)$foundCurrency['cost_one_dollar'];
            return sprintf($template,$dollarAmount);

        },$string);

        return $result;
    }
}