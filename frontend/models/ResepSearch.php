<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Resep;

/**
 * ResepSearch represents the model behind the search form of `frontend\models\Resep`.
 */
class ResepSearch extends Resep
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resepID', 'apotekerID', 'pendaftaranID', 'resepTotalHarga'], 'integer'],
            [['resepTanggal', 'resepStatus'], 'safe'],
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
        $query = Resep::find();

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
            'resepID' => $this->resepID,
            'apotekerID' => $this->apotekerID,
            'pendaftaranID' => $this->pendaftaranID,
            'resepTotalHarga' => $this->resepTotalHarga,
        ]);

        $query->andFilterWhere(['like', 'resepTanggal', $this->resepTanggal])
            ->andFilterWhere(['like', 'resepStatus', $this->resepStatus]);

        return $dataProvider;
    }
}
