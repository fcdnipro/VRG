<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use app\models\Book;
use app\models\Author;
$this->title = 'Book';
?>

<div class="site-book">
    <button class="btn btn-primary create-book">Create Book</button>
    <?php $form = ActiveForm::begin([
        'id' => 'book-author-search-form',
        'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-md-5\">{input}</div><div class=\"col-md-4\">{error}</div>",
        'labelOptions' => ['class' => 'col-md-3 control-label'],
        ],
    ]);

    echo $form->field($model,'authors')->widget(\kartik\select2\Select2::className(),[
        'name' =>'state_10',
        'id' => 'book-find-authors_id',
        'data' => Author::getAuthors(),
        'options' => [
            'placeholder' => 'Select Authors',
        ]
    ]);
    ActiveForm::end() ?>
        <form id="AuthorSearchForm" class="form-inline">
            <div class="form-group col-md-4">
               <label class='lab' for="bookTitle">Find for book title:</label>
                <input id="bookTitle" class="form-control col-md-6 text-book-find">
            </div>
            <div class="form-group col-md-4">
                <button class="btn btn-primary find-book" >Find Book</button>
                <button class="btn btn-primary reset-book">Reset all search</button>
            </div>

        </form>
    <br>
        <h1><?= Html::encode($this->title) ?></h1>
        <?php Pjax::begin([ 'id' => 'bookGrid']); ?>
        <?= $this->context->renderPartial('book_grid', ['dataProvider' => $dataProvider]) ?>
        <?php Pjax::end();?>
</div>

    <div id="BookModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <?= $this->context->renderPartial('book_modal', ['model' => $model]) ?>
        </div>
    </div>
