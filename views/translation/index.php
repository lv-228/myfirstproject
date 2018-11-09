<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TranslationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Трансляции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать трансляцию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'start_date',
            'status:boolean',
            'data_create',
            'moder',
            [
                'attribute' => 'team_a_id',
                'value' => 'teama.name',
            ],
            [
                'attribute' => 'team_b_id',
                'value' => 'teamb.name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
