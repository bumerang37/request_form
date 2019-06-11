<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Request */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/forms','Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role == 5) : ?>
    <p>
        <?= Html::a(Yii::t('app/forms','Update'), ['update', 'id' => $model->request_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/forms','Delete'), ['delete', 'id' => $model->request_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <? endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'request_id',
            'name',
            'message',
            [
                'attribute' => 'image',
//                'filterType' => GridView::FILTER_DATE_RANGE,
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->getImage(),
                        ['width' => '200px']);
                },
            ],
            'list',
            [
                'format' => 'raw',
                'attribute' => 'created_at',
                'value' => function (\app\models\Request $data) {
                    return Yii::$app->formatter->asDatetime($data->created_at);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'updated_at',
                'value' => function (\app\models\Request $data) {
                    return Yii::$app->formatter->asDatetime($data->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
