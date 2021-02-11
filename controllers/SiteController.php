<?php

namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\data\ActiveDataProvider;;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
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

        return $this->render('Author/author',['dataProvider'=>$dataProvider,'model' => $model]);
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

        return $this->renderPartial('Author/author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionRefreshModel()
    {
        $model = new Author();
        return $this->renderAjax('Author/author_modal',['model' => $model]);
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
            return $this->render('Author/author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
        }

        return $this->renderAjax('Author/author_modal', [
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

        return $this->render('Author/author',['dataProvider'=>$dataProvider,'model' => $model]);
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

            return $this->renderPartial('Author/author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
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

        return $this->renderPartial('Author/author_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }
    /**
     * Displays BOOK page.
     *
     * @return string
     */
    public function actionBook()
    {
        $model = new Book();
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('Book/book',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionCreateBook()
    {
        $data = Yii::$app->request->post('Book');
        $model = new Book();
        $formated_data =[
            'book_title' => $data['book_title'],
            'short_description' => $data['short_description'],
            'picture_path' => $data['imageFile'],
            'authors_id' => implode(',',$data['authors_id']),
            'publication_date' => $data['publication_date'],
        ];

        $model->load(['Book' =>$formated_data]);
        if(!$model->save()){
            echo "Error create book!";
            var_dump($model->getErrors());
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'pagination' => [
                'pageSize' => 15,
            ],

        ]);

        return $this->renderPartial('Book/book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionRefreshModelBook()
    {
        $model = new Book();
        return $this->renderAjax('Book/book_modal', [
            'model' => $model
        ]);
    }

    public function actionEditBook($id)
    {
        $model = Book::find()->where(['id' => $id])->one();

        if (Yii::$app->request->post()) {

            $model = Book::findOne($id);

            $data = Yii::$app->request->post('Book');
            $formated_data =[
                'book_title' => $data['book_title'],
                'short_description' => $data['short_description'],
                'picture_path' => !empty($data['imageFile']) ? $data['imageFile'] : $model->picture_path,
                'authors_id' => implode(',',$data['authors_id']),
                'publication_date' => $data['publication_date'],
            ];

            $model->load(['Book' =>$formated_data]);

            if (!$model->save()) {
                var_dump($model->getErrors());
                var_dump('Error edit author id='. $id .'!');
            }
            $dataProvider = new ActiveDataProvider([
                'query' => Book::find(),
                'pagination' => [
                    'pageSize' => 15,
                ],

            ]);
            return $this->render('Book/book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
        }

        return $this->renderAjax('Book/book_modal', [
            'model' => $model
        ]);

    }

    public function actionDeleteBook($id)
    {
        $model = Book::find()->where(['id' => $id])->one();
        !empty($model) ? $model->delete() : var_dump('Error delete author id='. $id .'!');
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'pagination' => [
                'pageSize' => 15,
            ],

        ]);

        return $this->render('Book/book',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionResetSearchBook(){
        $model = Book::find();
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->renderPartial('Book/book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionFindBook()
    {
        $data = Yii::$app->request->post();
        $text = $data['text'];
        $model = Book::find()->where(['like' ,'book_title',$text]);
        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->where(['like' ,'book_title',$text]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->renderPartial('Book/book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionFindBookAuthor()
    {
        $data = Yii::$app->request->post();
        $books_id = [];
        $text = explode(' ',$data['text']);
        $model = Author::find()->where(['and' ,['IN','first_name',$text[0]],['IN','last_name',$text[1]]])->asArray()->one();
        $books = Book::find()->asArray()->all();
        foreach ($books as $book){
            $authors = explode(',',$book['authors_id']);
            if (in_array($model['id'],$authors)){
                $books_id[]=$book['id'];
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->where(['id' => $books_id]),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->renderPartial('Book/book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }
}
