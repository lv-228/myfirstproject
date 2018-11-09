<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModeratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Модераторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moderator-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать модератора', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'login',
            // 'created_at',
            //'rolenameid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
