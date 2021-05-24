<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Author';
?>
<div class="site-author">
    <button class="btn btn-primary create-author">Create Author</button>
    <form id="AuthorSearchForm" class="form-inline">
        <label for="authorTitle" class="lab">Find for:</label>
            <select id="authorTitle" class="form-control type-author-find">
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
            </select>
            <input class="form-control col-md-6 text-author-find">
    <button class="btn btn-primary find-author" >Find Author</button>
    <button class="btn btn-primary reset-author" >Reset</button>
    </form>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin([ 'id' => 'authorGrid']); ?>
        <?= $this->context->renderPartial('author_grid', ['dataProvider' => $dataProvider]) ?>
    <?php Pjax::end();?>
</div>

    <div id="AuthorModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <?= $this->context->renderPartial('author_modal', ['model' => $model]) ?>
        </div>
    </div>
