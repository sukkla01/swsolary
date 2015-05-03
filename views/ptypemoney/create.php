<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ptypemoney */

$this->title = 'Create Ptypemoney';
$this->params['breadcrumbs'][] = ['label' => 'Ptypemoneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ptypemoney-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
