<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table table-striped table-bordered'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'first_name',
        'last_name',
        'middle_name',


        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{update}{delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil edit-author" data-id="' . $model->id . '"></span>','');
                },
                'delete' => function ($url, $model){
                    return Html::a('<span class="glyphicon glyphicon-trash delete-author"></span>',['site/delete-author', 'id' => $model->id],[
                        'data' => [
                            'confirm' => 'You are sure? Author will be permanently deleted.',
                            'pjax' => '1',
                            'method' => 'post',
                        ],
                    ]);
                },
            ],
        ],
    ],
]); ?>

