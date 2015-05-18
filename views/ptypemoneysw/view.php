<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PtypemoneySw */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ptypemoney Sws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ptypemoney-sw-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'name',
            'detail',
            'status',
        ],
    ]) ?>

</div>
