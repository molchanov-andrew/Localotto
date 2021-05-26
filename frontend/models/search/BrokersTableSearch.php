<?php

namespace frontend\models\search;


use common\models\queries\LotteryQuery;
use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Broker;
use common\models\records\BrokerStatus;
use common\models\records\BrokerToLottery;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\UrlManager;

class BrokersTableSearch extends Model
{
    public $limit = 50;

    public $lottery = '';
    public $tested = '';
    public $bonuses = '';
    public $systematic = '';
    public $scan_ticket = '';
    public $syndicat = '';
    public $paymentMethods = '';
    public $languages = '';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'lottery',
                'tested',
                'bonuses',
                'systematic',
                'scan_ticket',
                'syndicat',
                'paymentMethods',
                'languages',
            ],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Broker::find()->selectAll()->withBrokersTableRelatedData()->orderByPositions(\Yii::$app->pageData->pageContent->languageId)->published();
        // add conditions that should always apply here

        $this->load($params);

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
        ]);
        if($this->lottery !== ''){
            $btlBrokers = BrokerToLottery::find()->select('brokerId')->andWhere(['lotteryId' => $this->lottery])->all();
            $query->andWhere(['id' => array_column($btlBrokers,'brokerId')]);
        }

        if($this->tested !== '' && ((int)$this->tested === 0 || (int)$this->tested === 1)) {
            if((int)$this->tested === 0){
                $statuses = BrokerStatus::find()->select('id')->andWhere(['isPositive' => 0])->all();
            } else {
                $statuses = BrokerStatus::find()->select('id')->andWhere(['isPositive' => 1])->all();
            }
            $query->andWhere(['statusId' => array_column($statuses,'id')]);
        }

        if($this->bonuses !== ''){
            $bonusBrokers = (new \yii\db\Query())
                ->select(['brokerId'])
                ->from('BrokerToBonus')
                ->where(['bonusId' => $this->bonuses])
                ->all();

            $query->andWhere(['id' => array_column($bonusBrokers,'brokerId')]);
        }

        if($this->paymentMethods !== ''){
            $pmBrokers = (new \yii\db\Query())
                ->select(['brokerId'])
                ->from('BrokerToPaymentMethod')
                ->where(['paymentMethodId' => $this->paymentMethods])
                ->all();

            $query->andWhere(['id' => array_column($pmBrokers,'brokerId')]);
        }
        if($this->systematic !== ''){
            $query->andWhere(['systematic' => $this->systematic]);
        }
        if($this->scan_ticket !== ''){
            $query->andWhere(['scanTicket' => $this->scan_ticket]);
        }
        if($this->syndicat !== ''){
            $query->andWhere(['syndicat' => $this->syndicat]);
        }

        if($this->languages !== ''){
            $languageBrokers = (new \yii\db\Query())
                ->select(['brokerId'])
                ->from('BrokerToLanguage')
                ->where(['languageId' => $this->languages])
                ->all();

            $query->andWhere(['id' => array_column($languageBrokers,'brokerId')]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}