<?php

namespace app\controllers;

use yii;
use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = 'ค้นหาเจ้าหน้าที่';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <div class="panel panel-material-green-300">
        <div class="panel-heading">
            <h3 class="panel-title"> <i class='glyphicon glyphicon-search'></i> ค้นหาข้อมูล</h3>
        </div>
        <div class="panel-body">
            <?= Html::beginForm(); ?>
            <div class="col-md-6">
                รหัสบัตรประชาชน 13 หลัก:
                <input type="text" name="cid" class="form-control" placeholder="XXXXXXXXXXXXX">
            </div>   
            <div class="col-md-6">
                ชื่อ-สกุล:
                <input type="text"  name="tname" class="form-control" placeholder="ชื่อ-สกุล">
            </div>  
            <?= Html::submitButton('ประมวลผล', ['class' => 'btn btn-material-pink-400']); ?>


            <?= Html::endForm(); ?>
        </div>
    </div>
</div>


<?php if (Yii::$app->request->isPost) { ?>

    <div class="col-md-12">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'panel' => [
                'heading' => "<h3 class='panel-title'><i class='glyphicon glyphicon-signal'></i> รายชื่อการค้นหา</h3>",
                'type' => 'danger',
                //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                //'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/upload/upload'], ['class' => 'btn btn-info']),
                'footer' => false
            ],
            'responsive' => true,
            'hover' => true,
            'pjax' => true,
            'pjaxSettings' => [
                'neverTimeout' => true,
                'beforeGrid' => '',
                'afterGrid' => '',
            ],
            'columns' => [
                //['class'=>'yii\grid\SerialColumn'],

                [
                    'label' => 'รหัส',
                    'attribute' => 'ssn',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'raw',
                    'value' => function($model) {
                return Html::a(Html::encode($model['ssn']), [
                            '/smonthlist/searchsmonth',
                            'ssn' => md5($model['ssn']),
                ]);
            }// end value
                ],
                [
                    'label' => 'ชื่อ-สกุล',
                    'attribute' => 'name',
                    'headerOptions' => ['class' => 'text-center'],
                    
                ],
                [
                    'label' => 'แผนก',
                    'attribute' => 'DEPTNAME',
                    'headerOptions' => ['class' => 'text-center'],
                    
                ],
            ]
        ]);
        ?>
    </div>


<?php } ?>






