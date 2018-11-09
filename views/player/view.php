<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Player */

$this->title = $model->nick;
$this->params['breadcrumbs'][] = ['label' => 'Игроки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="player-view">

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
            //'id',
            'nick',
            [
                    'attribute' => 'icon',
                    'label'     => 'Иконка',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->icon), ['alt'=>'myImage','width'=>'100','height'=>'100',' target' => '_blank']),
                                yii\helpers\Url::toRoute([$model->icon])
                            )
                            ;
                    }
            ],
            [
            'label' => 'Команда',
            'value' => $model->team["name"],
            ],
            'player_role',
        ],
    ]) ?>

</div>
