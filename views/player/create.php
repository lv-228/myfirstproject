<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Player */

$this->title = 'Создать игрока';
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->getFlash('imageErrorPlayer'))
 echo Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('imageErrorPlayer'),
    ]);
?>
<div class="player-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
