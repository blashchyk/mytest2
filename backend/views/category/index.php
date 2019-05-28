<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Category;

?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['action' => 'create']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class='form-group field-attribute-parentId'>
        <?= Html::label('Parent', 'parent', ['class' => 'control-label']);?>
        <?= Html::dropdownList(
            'Category[parentId]',
            $model->parentId,
            Category::getTree($model->id),
            ['prompt' => 'No Parent (saved as root)', 'class' => 'form-control']
        );?>

    </div>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>