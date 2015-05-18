<?php
/* @var $this yii\web\View */
$this->title = 'MOPH Report';

Yii::$app->db->open();
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>ระบบเงินเดือนออนไลน์</h1>

        

        <p>
        <?= Html::a('ดูเงินเดือน', ['/smonthlist/smonth'], ['class'=>'btn btn-lg btn-success']);?>
        </p>
    </div>

    
</div>
<?php
 //echo Yii::$app->security->generatePasswordHash('1234');