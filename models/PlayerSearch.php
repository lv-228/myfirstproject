<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Player;

/**
 * PlayerSearch represents the model behind the search form about `app\models\Player`.
 */
class PlayerSearch extends Player
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'team_id'], 'integer'],
            [['nick', 'icon'], 'safe'],
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
        $query = Player::find();

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
            'team_id' => $this->team_id,
        ]);

        $query->andFilterWhere(['like', 'nick', $this->nick])
            ->andFilterWhere(['like', 'icon', $this->icon]);

        return $dataProvider;
    }
}
