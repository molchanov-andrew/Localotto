<?php

namespace frontend\models\search;

use common\models\queries\PageContentQuery;
use common\models\queries\PageQuery;
use common\models\records\Broker;
use common\models\records\Lottery;
use common\models\records\Setting;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\UrlManager;

/**
 * Date: 6/30/18
 */

class LotteriesTableSearch extends Lottery
{
    public $limit = 50;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

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
        $query = Lottery::find()->selectAll()->withLotteryTableRelatedData()->withBrokerToLotteryCount()->orderByPositions(\Yii::$app->pageData->currentLanguage->id)->published();

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

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}