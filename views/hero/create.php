<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Hero */

$this->title = 'Создать героя';
$this->params['breadcrumbs'][] = ['label' => 'Герои', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->getFlash('imageErrorHero'))
 echo Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('imageErrorHero'),
    ]);
?>
<div class="hero-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
