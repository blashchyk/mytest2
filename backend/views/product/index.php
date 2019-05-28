<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['action' => 'create']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>


    <?=$form->field($model, 'category')->checkboxList($categories, ['separator' => '<br>']);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>