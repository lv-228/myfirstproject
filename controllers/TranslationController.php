<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Translation;
use app\models\TranslationSearch;
use app\models\Player;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Moderator;

/**
 * TranslationController implements the CRUD actions for Translation model.
 */
class TranslationController extends Controller
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
                        'actions' => ['create', 'delete', 'update','index'],
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
     * Lists all Translation models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $searchModel = new TranslationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Translation model.
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
     * Creates a new Translation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $model = new Translation();

        if ($model->load(Yii::$app->request->post())) {
            $model->data_create=date("Y-m-d H:i:s");
            $model->moder = Yii::$app->user->identity->login;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Translation model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Translation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBeta()
    {
        if (Yii::$app->request->post()){

        $model = Translation::find()->where(['id' => $_POST['id']])->one();

        $model->delete = true;

        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);

        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    /**
     * Finds the Translation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Translation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Translation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOn($id=NULL)
    {

        $model = Translation::find()->where(['id' => $id])->one();

        $model->status = true;

        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionOff($id=NULL)
    {

        $model = Translation::find()->where(['id' => $id])->one();

        $model->status = false;

        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionUpdatescoreb()
    {

        

        if (Yii::$app->request->post()){
        $model = Translation::find()->where(['id'=> $_POST['trans_id']])->one();

        $model->team_b_score = $_POST['scoreb'];

        $model->save();
        
        echo json_encode($model->team_b_score);
    }


    }

    public function actionUpdatescorea()
    {
        if (Yii::$app->request->post()){

        $model = Translation::find()->where(['id'=> $_POST['trans_id']])->one();

        $model->team_a_score = $_POST['scorea'];

        $model->save();

        echo json_encode($model->team_a_score);
        }
    }

    public function actionUpdateteama()
    {
        if (Yii::$app->request->post()){

        $model = Translation::find()->where(['id'=>$_POST['trans_id']])->one();

        $model->team_a_id = $_POST['Translation']['team_a_id'];

        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
    }

    public function actionUpdateteamb()
    {
        if (Yii::$app->request->post()){

        $model = Translation::find()->where(['id'=>$_POST['trans_id']])->one();

        $model->team_b_id = $_POST['Translation']['team_b_id'];

        $model->save();

        return $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function actionApialltrans()
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	$all_translation = Translation::find()->all();
    	return $all_translation;
    }

    public function actionApiaboutteama()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $translation = Translation::find()->where(['id' => $_GET['tr']])->one();
        $team = Player::find()->where(['team_id' => $translation->teama['id']])->all();
        $response[0] = $translation->teama;
        $response[1] = $team;
        return $response;
    }

    public function actionApiaboutteamb()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $translation = Translation::find()->where(['id' => $_GET['tr']])->one();
        $team = Player::find()->where(['team_id' => $translation->teamb['id']])->all();
        $response[0] = $translation->teama;
        $response[1] = $team;
        return $response;
    }
}
