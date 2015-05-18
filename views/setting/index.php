<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>



<div class="col-md-12">
    <div class="panel panel-material-green-300">
        <div class="panel-heading">
            <h3 class="panel-title">ตั่งค่าเจ้าหน้าที่</h3>
        </div>
        <div class="panel-body">
            <div class="list-group">
               
                <a href="<?=Url::to('index.php?r=user/admin')?>" class="list-group-item list-group-item-success"><h4>1.กำหนด Users</h4></a>
                <a href="<?=Url::to('index.php?r=admin/route')?>" class="list-group-item list-group-item-info"><h4>2.กำหนดเส้นทางการเข้าถึง</h4></a>
                <a href="<?=Url::to('index.php?r=admin/permission')?>" class="list-group-item list-group-item-warning"><h4>3.กำหนดกลุ่มการเข้าถึง</h4></a>
                <a href="<?=Url::to('index.php?r=admin')?>" class="list-group-item list-group-item-danger"><h4>4.กำหนด user เข้ากลุ่ม</h4></a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-material-green-300">
        <div class="panel-heading">
            <h3 class="panel-title">ตั่งค่าระบบเงินเดือน</h3>
        </div>
        <div class="panel-body">
            <div class="list-group">
               
                <a href="<?=Url::to('index.php?r=ptypemoney')?>" class="list-group-item list-group-item-success"><h4>1.ชนิดรายรับรายจ่ายกรมบัญชีกลาง</h4></a>
                <a href="<?=Url::to('index.php?r=ptypemoneysw')?>" class="list-group-item list-group-item-info"><h4>2.ชนิดรายรับรายจ่ายโรงพยาบาล</h4></a>
                
            </div>
        </div>
    </div>
</div>


