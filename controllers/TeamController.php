<?php

namespace app\controllers;

use Yii;
use app\models\Team;
use app\models\Translation;
use app\models\TeamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\UploadForm;
use yii\filters\AccessControl;
use app\models\Moderator;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller
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
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $searchModel = new TeamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Team model.
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
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset($_SESSION['main_str'])){
            $this->layout = 'test';
        }

        $model = new Team();

        if ($model->load(Yii::$app->request->post())) {
            if(UploadedFile::getInstance($model, 'imageFile')){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');


                    $model->logo = 'teamlogo/'.$model->imageFile;

                    $model->save();

                    $model->imageFile->saveAs('teamlogo/' . $model->imageFile->baseName . '.' . $model->imageFile->extension);
            }
              else{ 
                    Yii::$app->session->setFlash('imageErrorTeam', 'Выберите картинку!');
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
     * Updates an existing Team model.
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
            if(UploadedFile::getInstance($model, 'imageFile')) {

                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                $model->logo = 'teamlogo/'.$model->imageFile;

                $model->save();

                $model->imageFile->saveAs('teamlogo/' . $model->imageFile->baseName . '.' . $model->imageFile->extension);
            }
            else $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        
        if($request1 = Translation::find()->where(['team_a_id'=>$id])->one() || $request2 = Translation::find()->where(['team_b_id'=>$id])->one()){
            Yii::$app->session->setFlash('successID', 'Нельзя удалить команду которая есть в трансляции!');
        }
        else {
            $path_to_file = Team::find()->where(['id'=>$id])->one();

            $path = '@webroot/'.$path_to_file->logo;

            unlink(Yii::getAlias("$path"));
            
            $this->findModel($id)->delete();
        }
        return $this->redirect('index');
    }

    /**
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
