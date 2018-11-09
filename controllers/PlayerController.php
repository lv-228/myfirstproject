<?php

namespace app\controllers;

use Yii;
use app\models\Player;
use app\models\PlayerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\UploadForm;
use yii\filters\AccessControl;
use app\models\Moderator;

/**
 * PlayerController implements the CRUD actions for Player model.
 */
class PlayerController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'update','index'],
                'rules' => [
                    [
                        'actions' => ['create', 'delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) { //вот вся магия с ролями
                         return Moderator::isUserAdmin(Yii::$app->user->identity->login);
                        }
                    ],
                                        [
                        'actions' => ['index','create', 'delete', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Player models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $searchModel = new PlayerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Player model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Player model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $model = new Player();

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'imageFile')){

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $model->icon = 'playericon/'.$model->imageFile;

                $model->save();

                $model->imageFile->saveAs('playericon/' . $model->imageFile->baseName . '.' . $model->imageFile->extension);

            }
            else{ 
                Yii::$app->session->setFlash('imageErrorPlayer', 'Выберите картинку!');
                return $this->render('create', [
                'model' => $model,
                    ]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Player model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'imageFile')){

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $model->icon = 'playericon/'.$model->imageFile;

                $model->save();

                $model->imageFile->saveAs('playericon/' . $model->imageFile->baseName . '.' . $model->imageFile->extension);
            }
            else $model->save();

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Player model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $path_to_file = Player::find()->where(['id'=>$id])->one();

        $path = '@webroot/'.$path_to_file->icon;

        unlink(Yii::getAlias("$path"));

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Player model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Player the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Player::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateplayer()
    {
        if (Yii::$app->request->post()){

            for($i = 0;$i<count($_POST['player_hidden']);$i++){
                $model = Player::find()->where(['id'=>$_POST['player_hidden'][$i]])->one();

                $model->nick=$_POST['player_nick'][$i];

                $model->hero_id = $_POST['hero_id'][$i];

                $model->save(false);

            }
        }

        return $this->redirect($_SERVER['HTTP_REFERER']);
            
    }
}
