<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><b>Автор</b>: Дмитрий Щепетихин,</p>
    <p><b>Git</b>: <a href="https://github.com/bumerang37" target="_blank">bumerang37</a>,</p>
    <p><b>Email</b>: <a href="mailto:bumerank@mail.ru">bumerank@mail.ru</a></p>

</div>
