<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/forms', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/forms', 'Create Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'request_id',
            'name',
            'message',
            [
                'attribute' => 'list',

            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {


                    return Html::img($data->getImage(),
                        ['width' => '200px']);
                },
            ],
            [
                'format' => 'datetime',
                'attribute' => 'created_at',
//                'value' => function (\app\models\Request $data) {
//                    return Yii::$app->formatter->asDatetime($data->created_at);
//                },
                'filter' => \kartik\daterange\DateRangePicker::widget([
                    'model' => $searchModel,
//                    'name' => 'insert_date',
                    'attribute' => 'created_at',
                    'startAttribute' => $date_start,
                    'endAttribute' => $date_end,
//                    'type'      => \kartik\daterange\DateRangePicker::TYPE_RANGE,
//                    'separator' => '-',
                    'pluginOptions' => [
                        'locale' => [
                            'cancelLabel' => 'Clear',
                            'format' => 'd.MM.Y',
                            'autoclose' => true,
                        ]
                    ],

                ]),
//                'format' => ['date', Yii::$app->formatter->datetimeFormat],

            ],

            ['class' => 'yii\grid\ActionColumn',
                'options' => ['width' => 70],
                'visibleButtons' => [
                    'update' => function ($data) {
                        return Yii::$app->user->identity->role === 5;
                    },

                    'delete' => function ($data) {
                        return Yii::$app->user->identity->role === 5;
                    },
                ]
            ],
        ],
    ]); ?>


</div>
