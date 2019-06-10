<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?php if($model->image): ?>
        <!--    --><?// var_dump(Yii::getAlias('@webroot/uploads/').$model->image) ?>

        <img src="<?= $model->image ?>" width="50%" height="auto" alt="">
    <?php endif; ?>
    <?= $form->field($model, 'image')->fileInput() ?>

    <?php
    $items = \yii\helpers\ArrayHelper::map($model->listFields,'id','name');
    ?>
    <?= $form->field($model, 'list')->dropDownList($items) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app/forms','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
