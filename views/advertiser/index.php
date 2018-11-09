<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdvertiserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рекламодатели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertiser-index">
    <?php 
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
        ['label' => 'Рекламодатели',
        'url' => ['advertiser/index']],
        ['label' => 'Баннеры',
        'url' => ['banner/index']],
        ['label' => 'Периоды показа',
        'url' => ['duration/index']],
        ]
        ]);
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать рекламодателя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'other',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
