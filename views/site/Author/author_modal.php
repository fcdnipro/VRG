<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Book';
?>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <?php
            $form = ActiveForm::begin([
                'id' => 'author-form',
                'options' => ['class' => 'form-horizontal'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-md-5\">{input}</div><div class=\"col-md-4\">{error}</div>",
                    'labelOptions' => ['class' => 'col-md-3 control-label'],
                ],
            ]) ?>

            <?= $form->field($model, 'first_name')->label('first_name') ?>

            <?= $form->field($model, 'last_name')->label('last_name') ?>

            <?=  $form->field($model, 'middle_name')->label('middle_name') ?>

            <?php ActiveForm::end() ?>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary <?= (empty($model->id) && empty($model->last_name)) ? 'create-author-btn">Create Author' : 'edit-author-btn" data-id='. $model->id .'>Edit Author'?></button>
        </div>
    </div>

