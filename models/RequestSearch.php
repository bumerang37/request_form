<?php

namespace app\models;

use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form of `\app\models\Request`.
 */
class RequestSearch extends Request
{
    public $date_start;
    public $date_end;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'message', 'list'], 'safe'],
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
        $query = Request::find();

        $date_start = date('Y-m-d', strtotime('-7 days'));
        $date_end = date('Y-m-d');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if($this->date_start && $this->date_end) {
            // filtered query

        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'message', $this->message])
//            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'list', $this->list]);

        $query->andFilterWhere(['>=', 'date', $this->date_start]);
        $query->andFilterWhere(['<=', 'date', $this->date_end]);

        return $dataProvider;
    }

    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'created_at',
                'dateStartAttribute' => 'date_start',
                'dateEndAttribute' => 'date_end',
                'dateStartFormat' => 'd-m-Y',
                'dateEndFormat' => 'd-m-Y',

            ]
        ];
    }
}
