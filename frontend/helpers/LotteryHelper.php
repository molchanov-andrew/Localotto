<?php

namespace frontend\helpers;


use common\models\records\SourceMessage;
use DateTime;
use LotteryResultLink;
use Yii;

class LotteryHelper
{
    public static function getLastResultLink($statisticPages)
    {
        $firstStatisticsPage = reset($statisticPages);
        $resultsPrefix = ($firstStatisticsPage) ? $firstStatisticsPage['prefix'] : false;
        if(!empty($this->data['lottoResults'])) {
            $firstResult = reset($this->data['lottoResults']);
            $timerName = $firstResult['timerName'];
            $data = $firstResult['data'];
        } else {
            return Yii::t(SourceMessage::CATEGORY_GENERAL,'No results to show for current lottery');
        }
        $datetime = DateTime::createFromFormat('d/m/Y',$data);
        if(!$datetime instanceof DateTime) {
            return  Yii::t(SourceMessage::CATEGORY_GENERAL, 'Winning Numbers');
        }

        return OldHelper::getDifferenceDateFromNowTagged(
            $data,
            Yii::t(SourceMessage::CATEGORY_GENERAL, 'lastResultDatesOnLottoPage'),
            array(
                '[lottery_name]' => Yii::t(SourceMessage::CATEGORY_LOTTERIES, $this->data['lotto']['lottery_name']),
                '[timer_name]' => empty($timerName) ? '' : ' ' . Yii::t(SourceMessage::CATEGORY_GENERAL, $timerName)
            ),
            true,
            LotteryResultLink::generateLinkByDate([
                'language' => $this->data['page']['iso'],
                'prefix' => $resultsPrefix,
                'lotteryLink' => $this->data['page']['url'],
                'date' => $data,
                'timerName' => $timerName
            ])
        );
    }


}