<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;
use yii\db\Expression;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{

    public $minPrice;
    public $maxPrice;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['minPrice', 'maxPrice'], 'number'],
            [['id', 'store_id', 'discount'], 'safe'],
            [['category', 'date_inserted', 'date_removed', 'product_name', 'product_sku', 'product_model_number', 'product_description', 'product_url', 'product_image', 'variant_name'], 'safe'],
        ];
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
        $query = Product::find()->select([
            'product_name', 'category', 'product_url', 'product_image', 'normal_price', 'sale_price',
            'discount' => new Expression('FLOOR(((normal_price - sale_price) / normal_price) * 100)')
        ])
            ->joinWith('prices')
            ->andWhere(['NOT LIKE', 'category', 'luggage'])
            ->orderBy('discount DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'store_id' => $this->store_id,
            'category' => $this->category

        ]);

        if($this->minPrice) {
            $query->andWhere(['>', 'sale_price', $this->minPrice]);
        }

        if($this->maxPrice) {
            $query->andWhere(['>', 'sale_price', $this->maxPrice]);
        }

        if($this->discount) {
            $query->andWhere(new Expression("FLOOR(((normal_price - sale_price) / normal_price) * 100) = '{$this->discount}'"));
        }

        $query->andFilterWhere(['like', 'product_name', $this->product_name]);

        return $dataProvider;
    }

    public function getCategories()
    {
        $query = Product::find()->groupBy('category')->select('category');
        if($this->store_id) {
            $query->andWhere(['store_id' => $this->store_id]);
        }

        return $query->indexBy('category')->column();

    }
}
