<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\records\Systematic;

/**
 * SystematicSearch represents the model behind the search form of `common\models\records\Systematic`.
 */
class SystematicSearch extends Systematic
{
    public $limit = 20;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'brokerToLotteryId', 'numbers', 'lines', 'limit'], 'integer'],
            [['created', 'updated'], 'safe'],
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
        $query = Systematic::find();

        // add conditions that should always apply here

        $this->load($params);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => (int)$this->limit,
            ],
        ]);

        if(empty($this->brokerToLotteryId) && isset($params['subParentId'])){
            $this->brokerToLotteryId = $params['subParentId'];
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'brokerToLotteryId' => $this->brokerToLotteryId,
            'numbers' => $this->numbers,
            'lines' => $this->lines,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}
