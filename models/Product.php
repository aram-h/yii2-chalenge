<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $category
 * @property int $store_id
 * @property string $date_inserted
 * @property string $date_removed
 * @property string $product_name
 * @property string $product_sku
 * @property string $product_model_number
 * @property string $product_description
 * @property string $product_url
 * @property string $product_image
 * @property string $variant_name
 *
 * @property Store $store
 * @property Price[] $prices
 */
class Product extends \yii\db\ActiveRecord
{

    public $discount;
    public $normal_price;
    public $sale_price;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id'], 'required'],
            [['store_id'], 'integer'],
            [['date_inserted', 'date_removed', 'discount'], 'safe'],
            [['product_description'], 'string'],
            [['category'], 'string', 'max' => 1000],
            [['product_name', 'product_sku', 'product_model_number', 'product_url', 'product_image', 'variant_name'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'store_id' => 'Store ID',
            'date_inserted' => 'Date Inserted',
            'date_removed' => 'Date Removed',
            'product_name' => 'Product Name',
            'product_sku' => 'Product Sku',
            'product_model_number' => 'Product Model Number',
            'product_description' => 'Product Description',
            'product_url' => 'Product Url',
            'product_image' => 'Product Image',
            'variant_name' => 'Variant Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::class, ['id' => 'store_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::class, ['product' => 'id']);
    }

    public static function getProductsProvider()
    {
        $query = Product::find()->select([
            'product_name', 'category', 'product_url', 'product_image', 'normal_price', 'sale_price',
            'discount' => new Expression('FLOOR(((normal_price - sale_price) / normal_price) * 100)')
        ])
            ->joinWith('prices')
            ->andWhere(['NOT LIKE', 'category', 'luggage'])
            ->orderBy('discount DESC');



        return new ActiveDataProvider([
            'query' => $query
        ]);


    }
}
