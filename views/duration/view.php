<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Duration */

$this->title = $model->banner['link'];
$this->params['breadcrumbs'][] = ['label' => 'Durations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duration-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'start_date',
            'end_date',
            'clicks_numbers',
            'show_numbers',
            'banner_id',
        ],
    ]) ?>

</div>
