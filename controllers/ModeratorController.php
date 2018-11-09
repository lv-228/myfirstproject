<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Moderator;
use app\models\ModeratorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * ModeratorController implements the CRUD actions for Moderator model.
 */
class ModeratorController extends Controller
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
                        'actions' => ['index','create', 'delete', 'update','index'],
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
     * Lists all Moderator models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $searchModel = new ModeratorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Moderator model.
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
     * Creates a new Moderator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $model = new Moderator();

        if ($model->load(Yii::$app->request->post())) {
            $pas = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($pas);
             $model->created_at=date("Y-m-d H:i:s");
             if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
             }

             else return $this->render('create', [
                'model' => $model,
            ]);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Moderator model.
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
            $pas = $model->password;
            $model->password = Yii::$app->security->generatePasswordHash($pas);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Moderator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Moderator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Moderator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Moderator::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
