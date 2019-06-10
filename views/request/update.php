<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = Yii::t('app/forms','Update Request: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->request_id]];
$this->params['breadcrumbs'][] = Yii::t('app/forms','Update');
?>
<div class="request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
