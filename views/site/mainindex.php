<?php use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Главная';
 ?>

<body class="bg">
  <div class="container">
    <div class="row">
        <div class="col-lg-1 col-md-1"></div>
        <div class="col-lg-4 col-md-4">
          <p class="caption-arhiv">Созданные трансляции</p>
          <div class="pre-scrollable start-list-tr">
          <ul class="list-group">
            <?php $i=0; foreach ($listtrans as $key => $value):?>
            <li class="list-group-item"><a href="<?php echo "http://dota.geos.tom.ru:2180/?trans_id=$value->id" ?>"><?= $value->name ?></a></li>
            <?php endforeach; ?>
          </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-4 col-md-4">
          <p class="caption-arhiv">Архив</p>
          <div class="pre-scrollable start-list-tr">

          <ul class="list-group">
            <?php $i=0; foreach ($listtrans_off as $key => $val):?>
                    <li role="presentation" class="list-group-item"><a href='<?php echo "http://dota.geos.tom.ru:2180/?trans_id=$val->id" ?>'><?= $val->name ?></a></li>
              <?php endforeach; ?>
          </ul>
          </div>
        </div>
        <div class="col-lg-1 col-md-1">

        </div>

    </div>

  </div>
  </body>