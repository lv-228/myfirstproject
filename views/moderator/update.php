<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Moderator */

$this->title = 'Изменение модератора: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Модераторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->login]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="moderator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
