<?php
/* @var $this yii\web\View */
/* @var $model app\models\Feedback */

$this->title = Yii::t('app', 'View');

?>

<dl class="dl-horizontal feedback-view">
    <dt><?= Yii::t('app', 'Type') ?></dt>
<!--    <dd>--><?//= Yii::t('app/feedback', $model->type) ?><!--</dd>-->

    <?php if ( $model->name ) { ?>
        <dt><?= Yii::t('app', 'Name') ?></dt>
        <dd><?= $model->name ?></dd>
    <?php } ?>

    <?php if ( $model->message ) { ?>
        <dt><?= Yii::t('app', 'Message') ?></dt>
        <dd><?= $model->message ?></dd>
    <?php } ?>

    <?php if ( $model->image ) { ?>
        <dt><?= Yii::t('app', 'image') ?></dt>
        <dd><?= $model->image ?></dd>
    <?php } ?>

    <?php if ( $model->list ) { ?>
        <dt><?= Yii::t('app', 'List') ?></dt>
        <dd><?= $model->list ?></dd>
    <?php } ?>


    <dt><?= Yii::t('app', 'Date') ?></dt>
    <dd><?= Yii::$app->formatter->asDatetime($model->created_at, 'medium') ?></dd>


</dl>