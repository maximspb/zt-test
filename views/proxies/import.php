<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proxy */

$this->title = 'Импортировать список прокси из csv-файла';
$this->params['breadcrumbs'][] = ['label' => 'Прокси', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proxy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_uploadCsvForm', [
        'model' => $model,
    ]) ?>

</div>