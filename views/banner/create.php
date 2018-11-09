<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = 'Создать баннер';
$this->params['breadcrumbs'][] = ['label' => 'Баннеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->getFlash('imageErrorBanner'))
 echo Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('imageErrorBanner'),
    ]);
?>
<div class="banner-create">
    <?= $this->render('_menu')?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>