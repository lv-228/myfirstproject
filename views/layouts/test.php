<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Translation;
use app\models\Moderator;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head> 
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        $listtrans = Translation::find()->where(['delete'=>false])->orderBy('data_create DESC')->all();

        $listtrans_off = Translation::find()->where(['delete'=>true])->limit('15')->orderBy('data_create DESC')->all();
        
        NavBar::begin([
            'brandLabel' => "Трансляции",
            'brandUrl' => 'http://dota.geos.tom.ru:2180',
            'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
        if(isset(Yii::$app->user->identity)&&Moderator::isUserAdmin(Yii::$app->user->identity->login)){

        ?>
    <div class="nav navbar-nav">
        <li class="dropdown">
                <a href="#" class="dropdown-toogle" data-toggle="dropdown">Список трансляций <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php $i=0; foreach ($listtrans as $key => $value):?>
                    <li role="presentation" class="my-dropdown"><a href="<?php echo "/?trans_id=$value->id" ?>"><?= $value->name ?></a>
                    <ul class="my_dropdown-menu">
                      <li><a href="http://dota.geos.tom.ru:2180/translation/on?id=<?=$value->id?>" class="btn btn-success" id="link_on<?=$value->id?>">Включить</a></li>
                      <li><a href="http://dota.geos.tom.ru:2180/translation/off?id=<?=$value->id?>" class="btn btn-danger" id="link_off<?=$value->id?>">Выключить</a></li>
                      <li><button style="width: 100%;" onclick="modal('<?= $value->name; ?>','<?= $value->id; ?>')" class="btn btn-warning" data-toggle="modal" data-target="#myModal" id="knopka">Удалить</button></li>
                    </ul>
                  </li>
                <?php endforeach; ?>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toogle" data-toggle="dropdown">Архив <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php $i=0; foreach ($listtrans_off as $key => $value):?>
                    <li role="presentation" class="my-dropdown"><a href="<?php echo "/?trans_id=$value->id" ?>"><?= $value->name ?></a>
                  </li>
                <?php endforeach; ?>
                </ul>
              </li>
            </div>
            <!-- Модальное окно пришлось править css из-за непонятного бага с z-index, раньше стоял z-index:1040;
            web/css/site.css -->

            <div class='modal fade' id='myModal'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h2 class='modal-title' id='myModalLabel'></h2>
                        </div>
                    <div class='modal-body'>
                        <h3>Вы уверены что хотите удалить трансляцию?</h3>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal' >Закрыть</button>
                        <a type='button' id='a_beta' class='btn btn-danger' onclick="submit_form()">Удалить</a>
                    </div>
                </div>
            </div>
        </div>

        <form id='beta_form' action="" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">
            <input id="input_id" type="hidden" name="id" value="">
        </form>

<!--             <button style="display: none;" type="hidden" class="btn btn-warning" data-toggle="modal" data-target="#myModal" id="knopka"></button> -->  
        <?php
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная','url' => ['/site/mainindex']],
            ['label' => 'Создать трансляцию', 'url' => ['/translation/create']],
            ['label' => 'Меню',
            'items' => [
                ['label' => 'Рекламный кабинет','url' => ['/advertiser/index'], 'items' =>[
                    ['label' => 'Создать рекламодателя', 'url' => ['/advertiser/create']],
                    '<li class="divider"></li>',
                    ['label' => 'Создать баннер', 'url' => ['/banner/create']],
                    '<li class="divider"></li>',
                    ['label' => 'Задать период', 'url' => ['/duration/create']],
                    '<li class="divider"></li>',
                ]],
                 '<li class="divider"></li>',
                 ['label' => 'Создать трансляцию', 'url' => ['/translation/create']],
                 '<li class="divider"></li>',
            ['label' => 'Зарегистрировать модератора', 'url' => ['/moderator/create']],
            '<li class="divider"></li>',
            ['label' => 'Модераторы', 'url' => ['/moderator/index']],
            '<li class="divider"></li>',
            ['label' => 'Команды', 'url' => ['/team/index']],
            '<li class="divider"></li>',
            ['label' => 'Игроки', 'url' => ['/player/index']],
            '<li class="divider"></li>',
            ['label' => 'Герои', 'url' => ['/hero/index']],
            '<li class="divider"></li>',
            ['label' => 'Трансляции', 'url' => ['/translation/index']],
            '<li class="divider"></li>',
            ]
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
}
        else {
            ?>
            <div class="nav navbar-nav">
                <li class="dropdown">
                <a href="#" class="dropdown-toogle" data-toggle="dropdown">Список трансляций <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php foreach ($listtrans as $key => $value):?>
                    <li role="presentation" class="my-dropdown"><a href="<?php echo "/?trans_id=$value->id" ?>"><?= $value->name ?></a>
                    <ul class="my_dropdown-menu">
                      <li><a href="http://dota.geos.tom.ru:2180/translation/on?id=<?=$value->id?>" class="btn btn-success" id="link_on">Включить</a></li>
                      <li><a href="http://dota.geos.tom.ru:2180/translation/off?id=<?=$value->id?>" class="btn btn-danger" id="link_off">Выключить</a></li>
                      <li><button style="width: 100%;" onclick="modal('<?= $value->name; ?>','<?= $value->id; ?>')" class="btn btn-warning" data-toggle="modal" data-target="#myModal" id="knopka">Удалить</button></li>
                    </ul>
                  </li>
                <?php endforeach; ?>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toogle" data-toggle="dropdown">Архив <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php $i=0; foreach ($listtrans_off as $key => $value):?>
                    <li role="presentation" class="my-dropdown"><a href="<?php echo "/?trans_id=$value->id" ?>"><?= $value->name ?></a>
                  </li>
                <?php endforeach; ?>
                </ul>
              </li>
            </div>

            <div class='modal fade' id='myModal'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'></button>
                            <h2 class='modal-title' id='myModalLabel'></h2>
                        </div>
                    <div class='modal-body'>
                        <h3>Вы уверены что хотите удалить трансляцию?</h3>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-primary' data-dismiss='modal' >Закрыть</button>
                        <a href='' type='button' id='a_beta' class='btn btn-danger'>Удалить</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Создать трансляцию', 'url' => ['/translation/create']],
            ['label' => 'Меню',
            'items' => [
                 ['label' => 'Создать трансляцию', 'url' => ['/translation/create']],
                 '<li class="divider"></li>',
            ['label' => 'Команды', 'url' => ['/team/index']],
            '<li class="divider"></li>',
            ['label' => 'Игроки', 'url' => ['/player/index']],
            '<li class="divider"></li>',
            ['label' => 'Герои', 'url' => ['/hero/index']],
            '<li class="divider"></li>',
            ['label' => 'Трансляции', 'url' => ['/translation/index']],
            '<li class="divider"></li>',
            ]
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->login . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    }

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<!--  -->

<script type="text/javascript">

    function modal(trans_name,id) {
        $('.modal-title').html(trans_name);
        $('#beta_form').attr('action','http://dota.geos.tom.ru:2180/translation/beta');
        $('#input_id').attr('value',id);
    }

    $('#button_off').click(function () {
         document.getElementById('link_on'+kostil).click();
    });

    $('#button_on').click(function () {
        document.getElementById('link_off'+kostil).click();
    });

    function submit_form() {
        $('#beta_form').submit();
    }

</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
