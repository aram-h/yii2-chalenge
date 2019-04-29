<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\ProductSearch */

$this->title = 'My Yii Application';
if(!$searchModel->discount) {
    $searchModel->discount = 0;
}
?>



<div class="site-index">

    <div class="col-md-3 left_bar product-search">
        <h2>Stores</h2>
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>


        <?= $form->field($searchModel, 'product_name')->label('Search by Name') ?>

        <?= $form->field($searchModel, 'store_id')->checkboxList(\app\models\Store::getStoresList()) ?>
        <div style="max-height: 300px; overflow: auto">
            <?= $form->field($searchModel, 'category')->checkboxList($searchModel->getCategories()) ?>
            <br >
            <br >
        </div>


        <?= $form->field($searchModel, 'minPrice')->input('number') ?>
        <?= $form->field($searchModel, 'maxPrice')->input('number') ?>

        <?= $form->field($searchModel, 'discount')->input('range', ['min' => 0, 'max' => 1000])->label('Discount - '.$searchModel->discount) ?>


       <!-- <div class="form-group">
            <?/*= Html::submitButton('Search', ['class' => 'btn btn-primary']) */?>
            <?/*= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) */?>
        </div>-->

        <?php ActiveForm::end(); ?>

    </div>
    <div class="col-md-9">
        <?=\yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_product'
        ])?>
    </div>



</div>
