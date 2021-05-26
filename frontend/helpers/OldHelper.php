<?php
/**
 * Date: 7/5/18
 */

namespace frontend\helpers;


use common\models\records\PageContent;
use common\models\records\SourceMessage;
use DateTime;
use Yii;

class OldHelper
{
    public static function formatResultsData(\DateTime $datetime)
    {
        $cases = array(
            'titled' => array('en','de','it'),
            'lowered' => array('ru','fr','es')
        );
        $language = strtolower(\Yii::$app->language);

        $time = $datetime->getTimestamp();

        // Checking do we need lowercase or titlecase of month depends to language.
        $month = Yii::t(SourceMessage::CATEGORY_GENERAL, date("F", $time));
        $month = in_array($language, $cases['lowered']) ? mb_convert_case($month,MB_CASE_LOWER, "UTF-8") : mb_convert_case($month, MB_CASE_TITLE, "UTF-8");

        switch($language){
            case 'en':{
                return $month.
                    date(" j Y", $time);
            }
            case 'ru':
            case 'uk':{
                return date("j ", $time).
                    mb_convert_case(Yii::t(SourceMessage::CATEGORY_GENERAL, date("F", $time) . '_a'),MB_CASE_LOWER, "UTF-8").
                    date(" Y", $time);
            }
            case 'fr':
            case 'it':
            case 'es':{
                return date("j ", $time).
                    $month.
                    date(" Y", $time);
            }
            case 'de':
            case 'cs':{
                return date("j. ", $time).
                    $month.
                    date(" Y", $time);
            }
            default:{
                return $month.
                    date(" j, Y", $time);
                break;
            }
        }
    }
    public static function replaceBuggedWMTSymbols($string)
    {
        return str_replace(['ú', 'ř', 'ě', 'č', 'á', 'í', 'ä','é','û'],['u','r','e','c','a','i','a','e','u'], $string);
    }

    public static function getValidMonths()
    {
        $months = array();
        for($i = 1; $i <= 12; $i++)
        {
            $date = DateTime::createFromFormat('n/d',$i.'/01');
            // This symbols are bugged in WMT, replacing them to simple latin.
            $monthName = self::replaceBuggedWMTSymbols(mb_strtolower(Yii::t(SourceMessage::CATEGORY_GENERAL,$date->format('F'))));
            $months[$date->format('n')] = $monthName;
        }
        return $months;
    }

    public static function getDateTimeDiffFromNow(DateTime $datetime)
    {
        $dStart = new DateTime();
        return $dStart->diff($datetime);
    }

    public static function replaceContentTags($replacements, $subject)
    {
        return str_replace(array_keys($replacements), $replacements, $subject);
    }

    public static function numberToWord($n, $titles, $language = '')
    {
        $lowerLanguage = mb_convert_case($language, MB_CASE_LOWER, "UTF-8");
        $languagesOnceSingle = array('en','fr','de','it','es');
        if(in_array($lowerLanguage,$languagesOnceSingle)) {
            return ($n == 1) ? $titles[0] : $titles[1];
        }
        $cases = array(2, 0, 1, 1, 1, 2);
        return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
    }

    /**
     * @param $replacementFunctionNames array function names to replace by , described in DynamicContentHelper.
     * @param $subject
     * @param array $params
     * @return string
     */
    public static function pregReplaceScriptedTags($replacementFunctionNames, $subject, array $params = []): string
    {
        foreach ($replacementFunctionNames as $functionName) {
            $subject = DynamicContentHelper::$functionName($subject, $params[$functionName]);
        }
        return $subject;
    }

    public static function pregReplaceComplexScriptedTags()
    {
        $dynamicTagFields = [
            'title',
            'keywords',
            'description',
            'additionalDescription',
            'alternativeDescription',
            'content1',
            'content2',
        ];
        $tags = [
            '[date_counter]' => 'getDifferenceYearAndDate',
            '[choose_currency]' => 'chooseCurrency',
            '[money]' => 'money',
        ];
        $params = [
            'getDifferenceYearAndDate' => ['template' => 'dateCounterLotteryString'],
            'chooseCurrency' => ['currencies' => Yii::$app->pageData->getCurrencies()],
            'money' => ['currencies' => Yii::$app->pageData->getCurrencies()],
        ];

        $pageContent = Yii::$app->pageData->getPageContent();
        foreach ($dynamicTagFields as $dynamicTagField) {
            if(is_string($pageContent->$dynamicTagField)) {
                $pageContent->$dynamicTagField = self::pregReplaceScriptedTags($tags, $pageContent->$dynamicTagField, $params);
            }
        }
        Yii::$app->pageData->setPageContent($pageContent);
    }

    public static function getDifferenceDateFromNowTagged($date, $subject, array $tags = [], $prefixed = true, $linkForDate = null)
    {
        $dStart = new DateTime();
        $dEnd = DateTime::createFromFormat('d/m/Y',$date);
        $dDiff = $dStart->diff($dEnd)->days;

        $tags['[dDiff]'] = $dDiff;

        if($dDiff == 0) {
            $text = $prefixed ? Yii::t(SourceMessage::CATEGORY_GENERAL, 'for today') : Yii::t(SourceMessage::CATEGORY_GENERAL, 'today');
        } elseif ($dDiff == 1) {
            $text = $prefixed ? Yii::t(SourceMessage::CATEGORY_GENERAL, 'for yesterday') : Yii::t(SourceMessage::CATEGORY_GENERAL, 'yesterday');
        } elseif($dDiff > 1) {
            // Too much work to get out spaces at empty notes, so we do like this.
            $text = empty(trim(Yii::t(SourceMessage::CATEGORY_GENERAL, "drawn days `ago` before"))) ? '' : Yii::t(SourceMessage::CATEGORY_GENERAL, "drawn days `ago` before").' ';
            $text .= $dDiff.' '.Yii::t(SourceMessage::CATEGORY_GENERAL, self::numberToWord($dDiff,array('day1','day2','day5')));
            $text .= empty(trim(Yii::t(SourceMessage::CATEGORY_GENERAL, 'drawn days `ago` after'))) ? '' : ' '.Yii::t(SourceMessage::CATEGORY_GENERAL, 'drawn days `ago` after');
        } else {
            $text = Yii::t(SourceMessage::CATEGORY_GENERAL, 'Winning Numbers');
        }
        $tags['[daysLeft]'] = '<span class="days-ago-text">' . $text . '</span>';
        $tags['[dateFormated]'] = self::formatResultsData($date);

        $tags['[linkBegin]'] = empty($linkForDate) ? '' : '<a href="' . $linkForDate . '" class="last-result-date">';
        $tags['[linkEnd]'] = empty($linkForDate) ? '' : '</a>';

        $tags['[taggedDateFormatted]'] = '<span class="last-result-date">' . $tags['[dateFormated]'] . '</span>';

        return ['text'=> self::replaceContentTags($tags, $subject),'diff' => $dDiff];
    }
}