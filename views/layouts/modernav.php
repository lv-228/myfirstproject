<?php require_once('sqllist.php'); 
  
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
?>

<div class="nav navbar-nav">
<li>
                <?php 
        if (!$thistranssql['status']) { 
?>
          <?= Html::submitButton('Offline', ['class' => 'btn btn-danger rabotay','id' =>'button_off']) ?>
<?php 
        }
        else {
?>
          <?= Html::submitButton('Online', ['class' => 'btn btn-success rabotay','id' =>'button_on']) ?>
<?php
        }
?>
</li>
              <li class="dropdown">
                <a href="#" class="dropdown-toogle" data-toggle="dropdown">Список трансляций <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php foreach ($listtrans as $key => $value):?>
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

          <form id='beta_form' action="" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken()?>">
            <input id="input_id" type="hidden" name="id" value="">
          </form>

        <?php
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная','url' => ['/site/mainindex']],
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

    NavBar::end();
    ?>