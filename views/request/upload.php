<?php
use yii\widgets\ActiveForm;
?>


<?php if($model->image): ?>
<!--    --><?// var_dump(Yii::getAlias('@webroot/uploads/').$model->image) ?>
    <?php
    $img = yii\helpers\Url::to('@web/uploads/').$model->image;
    ?>
    <img src="<?= $img ?>" width="50%" height="auto" alt="">
<?php endif; ?>

<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'image')->fileInput() ?>
    <button>Загрузить</button>
<?php ActiveForm::end() ?>