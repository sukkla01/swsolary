<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


 $this->title =  'นำเข้าข้อมูล Ver';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
    <div class="panel panel-material-grey-600">
        <div class="panel-heading">
            <h3 class="panel-title">นำเข้าข้อมูลแบบ Vertical</h3>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'options' => [
                            'enctype' => 'multipart/form-data'
                        ]
                    ])
            ?>
            <?= $form->field($model, 'file')->fileInput(); ?>
            <?= Html::submitButton('ส่งข้อมูล', ['class' => 'btn btn-material-pink-400']);
            ?>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

