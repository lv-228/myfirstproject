<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $model app\models\Team */

$this->title = 'Создать команду';
$this->params['breadcrumbs'][] = ['label' => 'Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->getFlash('imageErrorTeam'))
 echo Alert::widget([
        'options' => [
            'class' => 'alert alert-danger',
        ],
        'body' => Yii::$app->session->getFlash('imageErrorTeam'),
    ]);
?>
<div class="team-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
