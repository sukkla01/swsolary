<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* if (Yii::$app->request->isPost) {
  print_r($money);
  } */

$this->title = 'นำเข้าข้อมูลเงินโรงพยาบาล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
    <div class="panel panel-material-lime-600">
        <div class="panel-heading">
            <h3 class="panel-title">นำเข้าข้อมูลเงินโรงพยาบาล</h3>
        </div>
        <div class="panel-body">

            <div class="col-md-4">

                <?php
                $form = ActiveForm::begin([
                            'options' => [
                                'enctype' => 'multipart/form-data'
                            ]
                        ])
                ?>
                <?= $form->field($model, 'file')->fileInput(); ?>
            </div>
            <div class="col-md-6">
                เลือกวันที่ :
                <?php
                if (Yii::$app->request->isPost) {
                    $date1 = $date1;
                } else {
                    $date1 = date('Y-m-d');
                    ;
                }
                echo yii\jui\DatePicker::widget([
                    'name' => 'date1',
                    'value' => $date1,
                    'language' => 'th',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear' => true,
                    ],
                ]);
                ?>

            </div>
        </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= Html::submitButton('ส่งข้อมูล', ['class' => 'btn btn-material-pink-400']); ?>
            <?php ActiveForm::end(); ?>
    </div>
</div>


