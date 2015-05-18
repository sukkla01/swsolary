<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PtypemoneySw */

$this->title = 'Create Ptypemoney Sw';
$this->params['breadcrumbs'][] = ['label' => 'Ptypemoney Sws', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ptypemoney-sw-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
