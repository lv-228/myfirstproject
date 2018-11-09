<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Message;
use app\models\Moderator;
use app\models\Translation;
use yii\data\ActiveDataProvider;
use app\models\Player;

class SiteController extends Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($trans_id=0)
    {
        $_SESSION['main_str'] = 'okey';

        if(Translation::main()) return Yii::$app->response->redirect("site/mainindex");

        $model = new Message();

        if ($model->load(Yii::$app->request->post()) && (int)$trans_id>0) {

            $model->newMessage($trans_id);

            if ($model->save()) {

            return $this->render('index', [
                'model' => $model,
            ]); } 
            else {

            return $this->render('index', [
                'model' => $model,
            ]);
            }
        } else


            return $this->render('index', [
                'model' => $model,
            ]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'test';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->actionMainindex();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        // unset($_SESSION);
        //session_write_close();

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDelete($id)
    {
        //$objekt = new Message();
        Message::findOne($id)->delete();
        //$objekt->findModel($id)->

        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionUpdate($id)
    {

        if (Message::findOne($id)->load(Yii::$app->request->post()) && Message::findOne($id)->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionGettransid()
    {
        $first_trans_id = Translation::find()->orderBy('data_create DESC')->asArray()->one();

        return Yii::$app->response->redirect("http://dota.geos.tom.ru:2180/?trans_id=".$first_trans_id['id']);
    }

    public function actionMainindex(){

        $this->layout = 'test';

        unset($_SESSION['main_str']);

        $listtrans = Translation::find()->where(['delete'=>false])->orderBy('data_create DESC')->all();

        $listtrans_off = Translation::find()->where(['delete'=>true])->orderBy('data_create DESC')->all();

        return $this->render("/site/mainindex",['listtrans' => $listtrans,'listtrans_off' => $listtrans_off]);
    }

    public function actionUpdatemodal()
    {
        if(isset($_POST['mes_id'])){
        $model = new Message;
        $test = Message::jsonModalUpdate();
        echo json_encode($test);
        }
    }
    
}
