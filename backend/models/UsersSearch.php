<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Users;

/**
 * UsersSearch represents the model behind the search form of `backend\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'userPekerjaan'], 'integer'],
            [['username', 'userNama', 'password', 'userEmail', 'userTelephone', 'userAlamat', 'userFoto', 'userTanggalLahir', 'userJenisKelamin'], 'safe'],
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
        $query = Users::find();

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
            'userId' => $this->userId,
            'userPekerjaan' => $this->userPekerjaan,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'userNama', $this->userNama])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'userEmail', $this->userEmail])
            ->andFilterWhere(['like', 'userTelephone', $this->userTelephone])
            ->andFilterWhere(['like', 'userAlamat', $this->userAlamat])
            ->andFilterWhere(['like', 'userFoto', $this->userFoto])
            ->andFilterWhere(['like', 'userTanggalLahir', $this->userTanggalLahir])
            ->andFilterWhere(['like', 'userJenisKelamin', $this->userJenisKelamin]);

        return $dataProvider;
    }
}
