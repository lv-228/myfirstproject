<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Strongmoderator */

$this->title = 'Update Strongmoderator: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Strongmoderators', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="strongmoderator-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
