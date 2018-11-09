<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DurationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Период показа';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duration-index">
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
    <?php // echo $this->render('_search', ['model' => $searchModel]);
     ?>

    <p>
        <?= Html::a('Создать период', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'start_date',
            'end_date',
            'clicks_numbers',
            'show_numbers',
            ['attribute'=>'Рекламодатель',
            'value'=>'banner.advertiser.name'],
            ['attribute' => 'banner',
                    'label'     => 'Баннер',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->banner['image']), ['alt'=>'myImage','width'=>'100','height'=>'100']),
                                yii\helpers\Url::toRoute([$model->banner['image'],'target' => '_blank'])
                            )
                            ;
                    }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
