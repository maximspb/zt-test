<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proxy */

$this->title = 'Добавить прокси вручную';
$this->params['breadcrumbs'][] = ['label' => 'Прокси', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proxy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
