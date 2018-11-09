<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HeroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Герои';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать героя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'kda',
            'icon',
            [
                    'attribute' => 'icon',
                    'label'     => 'Иконка',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->icon), ['alt'=>'myImage','width'=>'100','height'=>'100']),
                                yii\helpers\Url::toRoute($model->icon),
                                [
                                        'target' => '_blank'
                                ]
                            )
                            ;
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
