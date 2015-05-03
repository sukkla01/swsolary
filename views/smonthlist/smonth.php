<?php
 $this->title =  'รายเดือน';
$this->params['breadcrumbs'][] = $this->title;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\grid\GridView;

echo Yii::$app->user->displayName;
?>
<div class="col-md-12">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h3 class="panel-title">ค้นหาข้อมูล</h3>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <?php
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'responsive' => true,
                    'hover' => true,
                    'pjax' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                        'beforeGrid' => '',
                        'afterGrid' => '',
                    ],
                    //'showPageSummary' => true,
                    'columns' => [
                        //['class'=>'yii\grid\SerialColumn'],

                        [
                            'label' => 'เดือน',
                            'attribute' => 'nmonth',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'format' => 'raw',
                            'value' => function($model)  {
                                return Html::a(Html::encode($model['nmonth']), [
                                    'smonthlist/smonth_cid',
                                    'cid' => $model['cid'],
                                    'year' => $model['fyear'],
                                    'mm' => $model['fmonth']
                                ]);
                            }// end value
                        ],
                        [
                            'label' => 'ปี',
                            'attribute' => 'fyear',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                    ]
                ]);
                ?>
            </div>

        </div>
    </div>
</div>