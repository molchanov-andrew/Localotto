<?php
/**
 * Date: 7/6/18
 */

namespace frontend\models\search;


use common\models\records\Lottery;
use common\models\records\Setting;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\UrlManager;

class LastResultsLotteriesSearch extends Model
{
    public $limit = 50;
    public $countryId;


    public function search($params)
    {
        $query = Lottery::find()
            ->selectAll()
            ->with([
                'brokerToLotteries' => function(ActiveQuery $query){
                    return $query->andWhere(['brokerId' => [\Yii::$app->pageData->settings[Setting::DEFAULT_BROKER_ID]->value, \Yii::$app->pageData->pageContent->page->promotingBrokerId]]);
                }
            ])
            ->withCountryData()
            ->withReviewPage()
            ->withBuyOnlinePage()
            ->withLogo()
            ->withLastResult()
            ->orderByPositions(\Yii::$app->pageData->currentLanguage->id)
            ->published();


        $this->load($params);
        if(isset($params['countryId'])){
            $this->countryId = $params['countryId'];
        }

        if($this->countryId !== null){
            $query->andWhere(['countryId' => $this->countryId]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'route' => '/' . \Yii::$app->pageData->pageContent->url,
                'urlManager' => new UrlManager([
                    'enablePrettyUrl' => true,
                    'enableStrictParsing' => true,
                    'showScriptName' => false,
                ]),
                'pageSize' => (int)$this->limit,
            ],
            'sort' => ['defaultOrder'=> ['jackpot' => SORT_ASC]]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}