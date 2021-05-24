<?php
    use kartik\date\DatePicker;
    use yii\bootstrap\ActiveForm;
?>
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">
    <?php    $form = ActiveForm::begin([
            'id' => 'book-form',
            'options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-md-5\">{input}</div><div class=\"col-md-4\">{error}</div>",
                'labelOptions' => ['class' => 'col-md-3 control-label'],
            ],
        ]) ?>
        <?= $form->field($model, 'book_title') ?>

        <?= $form->field($model, 'short_description') ?>

        <?= $form->field($model, 'authors_id')->widget(\kartik\select2\Select2::className(),[
            'name' =>'state_10',
            'data' => \app\models\Author::getAuthors(),
            'options' => [
                'placeholder' => 'Select Authors',
                'value' => !empty($model->id) ? explode(',',$model->authors_id) : $model->authors_id,
                'multiple' => true,
            ]
        ])?>
        <?=  $form->field($model, 'publication_date')->widget(DatePicker::className(),[
            'name' => 'dp_1',
            'type' => DatePicker::TYPE_INPUT,
            'value' => '23-02-1982',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ]); ?>
        <?= $form->field($model, 'imageFile')->widget(\dkhlystov\uploadimage\widgets\UploadImage::className()) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-primary <?= (empty($model->id) || $model->id == 0) ? 'create-book-btn">Create Book' : 'edit-book-btn" data-id='. $model->id .'>Edit Book'?></button>
    </div>
</div>


