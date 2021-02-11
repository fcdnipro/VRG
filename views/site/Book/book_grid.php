<?php

use dkhlystov\uploadimage\widgets\UploadImages;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-striped table-bordered'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'book_title',
        'short_description',
        [
            'label' => 'Image',
            'format' => 'raw',
            'value' => function($data) {
                if (file_exists(substr($data->picture_path, 1) )) {
                    $image = Html::img($data->picture_path, [
                        'alt'=>$data->picture_path,
                        'style' => 'width:70px;'
                    ]);
                    return Html::a($image,'#', [
                        'title' => Yii::t('yii', 'View'),
                        'data-id' => $data->id,
                    ]);
                } else {
                    return "Not exist image";
                }
            },
        ],
        [
            'attribute' => 'authors_id',
            'value' => function ($model) {
                return $model->getAuthorName();
            },
        ],
        'publication_date',
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{update}{delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil edit-book" data-id="' . $model->id . '"></span>','');
                },
                'delete' => function ($url, $model){
                    return Html::a('<span class="glyphicon glyphicon-trash delete-book"></span>',['site/delete-book', 'id' => $model->id],[
                        'data' => [
                            'confirm' => 'You are sure? Book will be permanently deleted.',
                            'pjax' => '1',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
    ],
]); ?>

