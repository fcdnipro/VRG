<?php
namespace app\controllers;

use app\models\Author;
use app\models\Book;
use Yii;
use yii\data\ActiveDataProvider;;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class BookController extends Controller
{
    public function actionBook()
    {
        $model = new Book();
        $dataProvider = new ActiveDataProvider([
        'query' => Book::find(),
            'pagination' => [
                'pageSize' => 15,
            ],
         ]);

    return $this->render('book',['dataProvider'=>$dataProvider,'model' => $model]);
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

    return $this->renderPartial('book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionRefreshModelBook()
    {
    $model = new Book();
    return $this->renderAjax('book_modal', [
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
    return $this->render('book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    return $this->renderAjax('book_modal', [
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

    return $this->render('book',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionResetSearchBook(){
    $model = Book::find();
    $dataProvider = new ActiveDataProvider([
    'query' => Book::find(),
    'pagination' => [
    'pageSize' => 15,
    ],
    ]);

    return $this->renderPartial('book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
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

    return $this->renderPartial('book_grid',['dataProvider'=>$dataProvider,'model' => $model]);
    }

    public function actionFindBookAuthor()
    {
    $data = Yii::$app->request->post();
    $books_id = [];
    $books = Book::find()->asArray()->all();
    foreach ($books as $book){
    $authors = explode(',',$book['authors_id']);
    if (in_array($data['id'],$authors)){
    $books_id[]=$book['id'];
    }
    }

    $dataProvider = new ActiveDataProvider([
    'query' => Book::find()->where(['id' => $books_id]),
    'pagination' => [
    'pageSize' => 15,
    ],
    ]);

    return $this->renderPartial('book_grid',['dataProvider'=>$dataProvider]);
    }
}
