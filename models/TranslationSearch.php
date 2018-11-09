<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Translation;

/**
 * TranslationSearch represents the model behind the search form about `app\models\Translation`.
 */
class TranslationSearch extends Translation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'moder_id', 'smoder_id'], 'integer'],
            [['name', 'start_date', 'data_create'], 'safe'],
            [['status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Translation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'moder_id' => $this->moder_id,
            'smoder_id' => $this->smoder_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'start_date', $this->start_date])
            ->andFilterWhere(['like', 'data_create', $this->data_create]);

        return $dataProvider;
    }
}
