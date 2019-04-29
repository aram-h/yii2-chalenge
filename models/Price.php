<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%prices}}".
 *
 * @property int $id
 * @property int $product
 * @property double $normal_price
 * @property double $sale_price
 * @property string $sale_start
 * @property string $sale_end
 *
 * @property Product $productModel
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product'], 'required'],
            [['product'], 'integer'],
            [['normal_price', 'sale_price'], 'number'],
            [['sale_start', 'sale_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'normal_price' => 'Normal Price',
            'sale_price' => 'Sale Price',
            'sale_start' => 'Sale Start',
            'sale_end' => 'Sale End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductModel()
    {
        return $this->hasOne(Product::class, ['id' => 'product']);
    }
}
