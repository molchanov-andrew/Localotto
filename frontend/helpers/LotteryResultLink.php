<?php


use common\models\records\SourceMessage;
use frontend\helpers\OldHelper;

class LotteryResultLink
{
    const TIMER_NAME_SEPARATOR = '-';

    public $language;
    public $prefix;
    public $lotteryLink;
    public $date;
    public $format='d/m/Y';
    public $year;
    public $month;
    public $timerName;

    private $_datetimeGeneratedFrom;

    public function __construct($config)
    {
        if(isset($config['language'])){
            $this->language = $config['language'];
        }
        if(isset($config['prefix'])){
            $this->prefix = $config['prefix'];
        }
        if(isset($config['lotteryLink'])){
            $this->lotteryLink = $config['lotteryLink'];
        }
        if(isset($config['date'])){
            $this->date = $config['date'];
        }
        if(isset($config['format'])){
            $this->format =  $config['format'];
        }
        if(isset($config['year'])){
            $this->year =  $config['year'];
        }
        if(isset($config['month'])){
            $this->month =  $config['month'];
        }
        if(isset($config['timerName'])){
            $this->timerName =  $config['timerName'];
        }
    }

    /**
     * @return bool|string
     */
    public function generateByDate()
    {
        $this->_datetimeGeneratedFrom = DateTime::createFromFormat($this->format,$this->date);
        // No datetime - no deal.
        if(!$this->_datetimeGeneratedFrom) {
            return false;
        }
        $year = $this->_datetimeGeneratedFrom->format('Y');
        $month = $this->_datetimeGeneratedFrom->format('n');
        $segments = array(
            // 1. powerball
            $this->lotteryLink,
            // 2. results-2017
            $this->prefix.'-'.$year,
        );
        $date = DateTime::createFromFormat('n/d',$month.'/01');
        // 3. August
        $monthSegment = mb_strtolower(Yii::t(SourceMessage::CATEGORY_GENERAL,$date->format('F'),[],$this->language),'UTF-8');
        $monthSegment = OldHelper::replaceBuggedWMTSymbols($monthSegment);
        $segments[] = $monthSegment;
        // 4. 20-10-2017
        $dateSegment = str_replace('/','-',$this->date);
        // 5. evening
        if(!empty($this->timerName)){
            if(empty($timerTranslation = Yii::t(SourceMessage::CATEGORY_GENERAL,$this->timerName,[],$this->language))){
                return false;
            }
            $timerTranslation = OldHelper::replaceBuggedWMTSymbols($timerTranslation);
            $segments[] = $dateSegment . self::TIMER_NAME_SEPARATOR . mb_strtolower($timerTranslation,'UTF-8');
        } else {
            $segments[] = $dateSegment;
        }
        return implode('/',$segments);
    }

    /**
     * @param $config
     * @return bool|string
     */
    public static function generateLinkByDate($config)
    {
        $lotteryResult = new self($config);
        return $lotteryResult->generateByDate();
    }

    /**
     * @return string
     */
    public function generateByParams()
    {
        $segments = array(
            $this->lotteryLink,
            $this->prefix.'-'.$this->year,
        );

        if(!empty($this->month)) {
            if(is_numeric($this->month) && $this->month > 0 && $this->month <= 12) {
                $date = DateTime::createFromFormat('n/d',$this->month.'/01');
                $monthSegment = mb_strtolower(Yii::t(SourceMessage::CATEGORY_GENERAL,$date->format('F'),$this->language),'UTF-8');
                // This symbols are bugged in WMT, replacing them to simple latin.
                $monthSegment = OldHelper::replaceBuggedWMTSymbols($monthSegment);
                $segments[] = $monthSegment;
            } else {
                $months = OldHelper::getValidMonths();
                if($monthNumber = array_search($this->month,$months)) {
                    $datetime = DateTime::createFromFormat('n',$monthNumber);
                    if(!$datetime) {
                        return implode('/',$segments);
                    }
                    $monthSegment = mb_strtolower(Yii::t(SourceMessage::CATEGORY_GENERAL,$datetime->format('F'),[],$this->language),'UTF-8');
                    $monthSegment = OldHelper::replaceBuggedWMTSymbols($monthSegment);
                    $segments[] = $monthSegment;
                } else {
                    return false;
                }
            }
        }
        if(!empty($this->date)) {
            $segments[] = str_replace('/','-',$this->date);
        }
        return implode('/',$segments);
    }

    /**
     * @param $config
     * @return string
     */
    public static function generateLinkByParams($config)
    {
        $lotteryResult = new self($config);
        return $lotteryResult->generateByParams();
    }
}