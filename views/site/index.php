<?php

/* @var $this yii\web\View */

$this->title = 'Главная страница';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Главная</h1>

        <p class="lead">С данной страницы можно быстро </p>


        <p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to(['site/login']) ?>">Перейти к
                авторизации</a></p>
<<<<<<< HEAD
        <p class="lead">и заполнению <a href="<?= \yii\helpers\Url::to(['/request/create'])?>"><span class='note'
=======
        <p class="lead">и заполнению <a href="<?= \yii\helpers\Url::to(['/request/index'])?>"><span class='note'
>>>>>>> e7d5e51660fcee8c12f858c9bc46026a5d5f436c
                                                      data-toggle="tooltip"
                                                      title="Просматривать оставленные заявки могут только авторизованные пользователи">формы обратной
            связи</span></a></p>
    </div>
    <?php if (!Yii::$app->user->isGuest) : ?>
    <p class="lead text-center">Пользователи зарегистрированные, и находящиеся в группе "Администраторы" могут</p>
        <div class="body-content">

            <div class="row">

                <div class="col-lg-<? echo Yii::$app->user->isGuest ? "6 " : "6 col-lg-offset-3 text-center" ?>">
                    <a class="btn btn-lg bg-info" href="<?= \yii\helpers\Url::to(['/request'])?>">Просмотреть созданные заявки</a>


                </div>

            </div>

        </div>
    <? endif; ?>
</div>
