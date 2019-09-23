<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProxySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список прокси';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proxy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?php if (Yii::$app->user->can('admin')) : ?>
        <?= Html::a('Добавить прокси', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif;?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'ip',
            'port',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn',
              'visibleButtons' => [
                'update' => Yii::$app->user->can('admin'),
                'delete' => Yii::$app->user->can('admin')
            ]
            ],

        ],
    ]); ?>


</div>
