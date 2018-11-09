<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Duration */

$this->title = 'Update Duration: ' . $model->banner['link'];
$this->params['breadcrumbs'][] = ['label' => 'Durations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="duration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
