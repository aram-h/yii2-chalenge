<?php
/* @var \app\models\Product $model*/

?>
<div class="col-md-4">
    <a href="<?=$model->product_url?>" target="_blank">
        <div class="product_item">
            <div>
                <?=\yii\helpers\Html::img($model->product_image, ['class' => 'img-responsive'])?>
            </div>
            <h5>Save <?=$model->discount?> %</h5>
            <h3>$<?=$model->sale_price?> <del>$<?=$model->normal_price?></del></h3>
            <h5>#<?=$model->product_sku?></h5>
            <h5>#<?=$model->product_name?></h5>
        </div>
    </a>


</div>
