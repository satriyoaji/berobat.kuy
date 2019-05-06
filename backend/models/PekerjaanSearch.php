<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Pekerjaan;

/**
 * PekerjaanSearch represents the model behind the search form of `backend\models\Pekerjaan`.
 */
class PekerjaanSearch extends Pekerjaan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pekerjaanID'], 'integer'],
            [['pekerjaanNama'], 'safe'],
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
        $query = Pekerjaan::find();

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
            'pekerjaanID' => $this->pekerjaanID,
        ]);

        $query->andFilterWhere(['like', 'pekerjaanNama', $this->pekerjaanNama]);

        return $dataProvider;
    }
}
