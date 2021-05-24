<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\data\ActiveDataProvider;;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class AuthorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
     * {@inheritdoc}
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
    public function actionIndex()
    {
        $model = new Author();
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'pagination' => [
                'pageSize' => 15,
            ],

        ]);

        return $this->render('author',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionCreateAuthor()
    {
        $data = Yii::$app->request->post();
        $model = new Author();
        $model->load($data);
        if(!$model->save()){
            echo "Error create author!";
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->renderPartial('author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionRefreshModel()
    {
        $model = new Author();
        return $this->renderAjax('author_modal',['model' => $model]);
    }

    public function actionEditAuthor($id)
    {
        $model = Author::find()->where(['id' => $id])->one();

        if (Yii::$app->request->post()) {

            $model = Author::findOne($id);
            $data = Yii::$app->request->post();
            $model->load($data);
                if (!$model->save()) {
                    var_dump($model->getErrors());
                    var_dump('Error edit author id='. $id .'!');
                }
            $dataProvider = new ActiveDataProvider([
                'query' => Author::find(),
                'pagination' => [
                    'pageSize' => 15,
                ],
            ]);
            return $this->render('author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
        }

        return $this->renderAjax('author_modal', [
            'model' => $model
        ]);

    }

    public function actionDeleteAuthor($id)
    {
        $model = Author::find()->where(['id' => $id])->one();
        !empty($model) ? $model->delete() : var_dump('Error delete author id='. $id .'!');
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('author',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionFindAuthor()
    {
        $data = Yii::$app->request->post();
        if(!empty($data['reset'])){
            $model = Author::find();
            $dataProvider = new ActiveDataProvider([
                'query' => Author::find(),
                'pagination' => [
                    'pageSize' => 15,
                ],
            ]);

            return $this->renderPartial('author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
        }
        $type = $data['type'];
        $text = $data['text'];
        $model = Author::find()->where(['like' ,$type,$text]);
        $dataProvider = new ActiveDataProvider([
            'query' => Author::find()->where(['like' ,$type,$text]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->renderPartial('author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }
}
