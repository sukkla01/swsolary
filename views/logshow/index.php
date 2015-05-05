<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use kartik\grid\GridView;


$this->title = 'Log Data';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="col-md-12">
        <?php
        
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'panel' => [
                'heading' => "<h3 class='panel-title'><i class='glyphicon glyphicon-globe'></i>Log เก็บข้อมูลการเข้าใช้โปรแกรม</h3>",
                'type' => 'danger',
                //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
                'after' => Html::a('<i class="glyphicon glyphicon-repeat"></i> โหลดข้อมูลใหม่', ['/upload/upload'], ['class' => 'btn btn-info']),
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
            'showPageSummary' => true,
            'columns' => [
                //['class'=>'yii\grid\SerialColumn'],

                [
                    'label' => 'รหัส',
                    'attribute' => 'user'
                ],
                [
                    'label' => 'ชื่อ-สกุล',
                    'attribute' => 'name'
                ],
                [
                    'label' => 'เข้าใช้',
                    'attribute' => 'detail'
                ],
                [
                    'label' => 'เดือน',
                    'attribute' => 'lmonth'
                ],
                [
                    'label' => 'ปี',
                    'attribute' => 'lyear'
                ],
                [
                    'label' => 'OS',
                    'attribute' => 'os'
                ],
                [
                    'label' => 'วันที่เข้าดู',
                    'attribute' => 'lastdate'
                ]
            ]
        ]);
        ?>
    </div>