<?php
$this->title = 'รายละเอียดเงินเดือน';
$this->params['breadcrumbs'][] = ['label' => 'รายเดือน', 'url' => ['smonthlist/smonth']];
$this->params['breadcrumbs'][] = $this->title;

$user = Yii::$app->user->displayName;
if (isset($_GET['ssn'])) {
    $user = $_GET['ssn'];
}
$gyear = $_GET['year'];
$gmonth = $_GET['mm'];

//***********************  เก็บ log *********************





$connection = Yii::$app->db;
//********************** detail*********************
$sql = "SELECT s.fyear,s.fmonth,m.nmonth,cid,CONCAT(pname,fname,' ',lname) AS ftname,
solary,money1,money2,money3,money4,money5,money6,money7,money8,money9,
			 money10,money11,money12,money13,money14,money15,money16,money17,money18,
			 money19,money20,money21,total_money
FROM p_solary_ver s
LEFT JOIN tbmonth m ON m.mm=s.fmonth
WHERE cid ='$user' AND  s.fyear='$gyear' AND s.fmonth='$gmonth'";
$data = $connection->createCommand($sql)
        ->queryAll();
//********************* header *******************************
$sqlc = "SELECT s.fyear,t.nmonth,CONCAT(pname,fname,' ',lname) AS tname,s.cid,
	d.deptname as tdept,CONCAT(bank,' ',code_bank) AS tbank,bank_account
FROM p_solary_ver s
LEFT JOIN userinfo uf ON uf.ssn=s.cid
LEFT JOIN dep d ON d.deptid=uf.DEFAULTDEPTID
LEFT JOIN tbmonth t ON t.mm=s.fmonth
WHERE cid='$user' AND fyear='$gyear' AND fmonth='$gmonth' ";
$datac = $connection->createCommand($sqlc)
        ->queryAll();
for ($nu = 0; $nu < sizeof($datac); $nu++) {
    $tyear = $datac[$nu]['fyear'];
    $tmonth = $datac[$nu]['nmonth'];
    $tname = $datac[$nu]['tname'];
    $tdept = $datac[$nu]['tdept'];
    $tbank = $datac[$nu]['tbank'];
    $tbank_account = $datac[$nu]['bank_account'];
    $tcid = $datac[$nu]['cid'];
}
?>




<div class="col-md-12">
    <div class="panel panel-material-light-green-700">
        <div class="panel-heading">
            รายละเอียด
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                ประจำเดือน : <?php echo $tmonth . ' ' . $tyear . '<br>'; ?>
                ชื่อ-สกุล : <?php echo $tname . '<br>'; ?>
                แผนก : <?php echo $tdept . '<br>'; ?>
            </div>
            <div class="col-md-6">
                รหัสบัตรประชาชน : <?php echo $tcid . '<br>'; ?>
                ชื่อธนาคาร : <?php echo $tbank . '<br>'; ?>
                เลขที่บัญชี : <?php echo $tbank_account . '<br>'; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="panel panel-material-light-green-700">
                <div class="panel-heading">
                    จำนวนเงินเดือนรายการรับ
                </div>
                <div class="panel-body">
                    <table class="table">


                        <tr class="success">
                            <td style="center">รายการ</td>
                            <td>จำนวนเงิน/บาท</td> 

                        </tr>


                        <?php for ($i = 0; $i < sizeof($data); $i++) { ?>

                            <tr>

                                <td> <?php
                                    $n = 1;
                                    echo $n . ' เงินเดือน ' . '<hr>';

                                    if ($data[$i]['money1'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' เงินเดือน (ตกเบิก)' . '<hr>';
                                    }
                                    if ($data[$i]['money2'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ง.บ.ส.ก.(110,120,130)';
                                        echo '<hr>';
                                    }
                                    if ($data[$i]['money4'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ต.ข.ท.ปจต.' . '<hr>';
                                    }
                                    if ($data[$i]['money8'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ต.พ.ข.ว319+ต.พ.ข.ว319(ตกเบิก)' . '<hr>';
                                    }
                                    ?>

                                    <div class="alert alert-dismissable alert-material-red-200">
                                        <?php echo ' รวมรายรับ '; ?>
                                    </div>
                                    <?php
                                    /* if ($data[$i]['money11'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' ภาษี+ภาษี(ตกเบิก)'.'<hr>';
                                      }
                                      if ($data[$i]['money12'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' ง.ท.สหกรณ์ + ง.ก.สหกรณ์'.'<hr>';
                                      }
                                      if ($data[$i]['money13'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' สะสม+สะสม(ตกเบิก)'.'<hr>';
                                      }
                                      if ($data[$i]['money14'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' ง.ก.บ.(ธอส.)'.'<hr>';
                                      }
                                      if ($data[$i]['money17'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' ฌปก.'.'<hr>';
                                      }
                                      if ($data[$i]['money20'] >= 1) {
                                      $n = $n + 1;
                                      echo $n . ' สธณภ.+งานศพ'.'<hr>';
                                      } */
                                    ?>

                                </td>
                                <td> <?php
                                    echo number_format(substr($data[$i]['solary'], 0, -2)) . '.' . substr($data[$i]['solary'], -2) . '<hr>';
                                    if ($data[$i]['money1'] >= 1) {
                                        echo number_format(substr($data[$i]['money1'], 0, -2)) . '.' . substr($data[$i]['money1'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money2'] >= 1) {
                                        echo number_format(substr($data[$i]['money2'], 0, -2)) . '.' . substr($data[$i]['money2'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money3'] >= 1) {
                                        echo number_format(substr($data[$i]['money3'], 0, -2)) . '.' . substr($data[$i]['money3'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money4'] >= 1) {
                                        echo number_format(substr($data[$i]['money4'], 0, -2)) . '.' . substr($data[$i]['money4'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money8'] >= 1) {
                                        echo number_format(substr($data[$i]['money8'], 0, -2)) . '.' . substr($data[$i]['money8'], -2) . '<hr>';
                                    }
                                    ?>
                                    <div class="alert alert-dismissable alert-material-red-200">
                                        <?php echo number_format(substr($data[$i]['money10'], 0, -2)) . '.' . substr($data[$i]['money10'], -2); ?>

                                    </div>

                                    <?php
                                    
                                    ?>

                                </td>
                            </tr>

                        <?php } ?>

                    </table>



                </div>
            </div>
        </div>

        <!--***************************  หัก ****************************************-->

        <div class="col-md-6">
            <div class="panel panel-material-light-green-700">
                <div class="panel-heading">
                    จำนวนเงินเดือนรายการหัก
                </div>
                <div class="panel-body">
                    <table class="table">


                        <tr class="success">
                            <td style="center">รายการ</td>
                            <td>จำนวนเงิน/บาท</td> 

                        </tr>


                        <?php for ($i = 0; $i < sizeof($data); $i++) { ?>

                            <tr>

                                <td> <?php
                                    $n = 1;

                                    if ($data[$i]['money11'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ภาษี+ภาษี(ตกเบิก)' . '<hr>';
                                    }
                                    if ($data[$i]['money12'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ง.ท.สหกรณ์ + ง.ก.สหกรณ์' . '<hr>';
                                    }
                                    if ($data[$i]['money13'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' สะสม+สะสม(ตกเบิก)' . '<hr>';
                                    }
                                    if ($data[$i]['money14'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ง.ก.บ.(ธอส.)' . '<hr>';
                                    }
                                    if ($data[$i]['money17'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' ฌปก.' . '<hr>';
                                    }
                                    if ($data[$i]['money20'] >= 1) {
                                        $n = $n + 1;
                                        echo $n . ' สธณภ.+งานศพ' . '<hr>';
                                    }
                                    ?>
                                    <div class="alert alert-dismissable alert-material-red-200">
                                        <?php echo ' รวมรายการหัก '; ?>
                                    </div>
                                </td>
                                <td> 

                                    <?php
                                    if ($data[$i]['money11'] >= 1) {
                                        echo number_format(substr($data[$i]['money11'], 0, -2)) . '.' . substr($data[$i]['money11'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money12'] >= 1) {
                                        echo number_format(substr($data[$i]['money12'], 0, -2)) . '.' . substr($data[$i]['money12'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money13'] >= 1) {
                                        echo number_format(substr($data[$i]['money13'], 0, -2)) . '.' . substr($data[$i]['money13'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money14'] >= 1) {
                                        echo number_format(substr($data[$i]['money14'], 0, -2)) . '.' . substr($data[$i]['money14'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money17'] >= 1) {
                                        echo number_format(substr($data[$i]['money17'], 0, -2)) . '.' . substr($data[$i]['money17'], -2) . '<hr>';
                                    }
                                    if ($data[$i]['money20'] >= 1) {
                                        echo number_format(substr($data[$i]['money20'], 0, -2)) . '.' . substr($data[$i]['money20'], -2) . '<hr>';
                                    }
                                    ?>
                                    <div class="alert alert-dismissable alert-material-red-200">
                                        <?php echo number_format(substr($data[$i]['money21'], 0, -2)) . '.' . substr($data[$i]['money21'], -2); ?>

                                    </div>
                                </td>
                            </tr>
                            <?php $total_money = number_format(substr($data[$i]['total_money'], 0, -2)) . '.' . substr($data[$i]['total_money'], -2); ?>
                        <?php } ?>

                    </table>



                </div>
            </div>
        </div>


    </div>
</div>

<div class="col-md-12">
    <div class="panel panel-material-light-green-700">

        <div class="panel-body">
            <div class="col-md-6" align="center">
                <div class="alert alert-dismissable alert-danger">
                    <h4>ยอดรับสุทธิ</h4>
                </div>
            </div>
            <div class="col-md-6" align="center">
                <div class="alert alert-dismissable alert-danger">
                    <h4><?= $total_money.' '.'บาท'; ?></h4>
                </div>
            </div> 
        </div>
    </div>


