<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\grid\GridView;
?>


<div class="col-md-12">
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'panel' => [
                'heading' => "<h3 class='panel-title'><i class='glyphicon glyphicon-globe'></i>รายชื่อการค้นหา</h3>",
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
                    'label' => 'รายการ',
                    'attribute' => 'tname',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'format' => 'raw',
                    'value' => function($model) {
                                return Html::a(Html::encode($model['tname']), [
                            '/smonthlist/smonth_cid',
                            'ssn' => md5($model['cid']),
                            'year' => $model['fyear'],
                            'mm' => $model['fmonth']
                ]);
            }// end value
                ]
            ]
        ]);
        ?>
    </div>