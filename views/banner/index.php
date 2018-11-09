<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;
use app\models\Banner;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">
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
        <?= Html::a('Создать баннер', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'link',
            'image',
           ['attribute' => 'advertiser_id',
           'value' => 'advertiser.name',
           ],
           [
                    'attribute' => 'image',
                    'label'     => 'Баннер',
                    'format'    => 'html',
                    'value' => function ($model) {
                        return Html::a(
                                Html::img(\yii\helpers\Url::toRoute($model->image), ['alt'=>'myImage','width'=>'100','height'=>'100']),
                                yii\helpers\Url::toRoute([$model->image,'target' => '_blank'])
                            )
                            ;
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
