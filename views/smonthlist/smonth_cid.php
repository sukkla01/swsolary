<?php
$this->title = 'รายละเอียดเงินเดือน';
$this->params['breadcrumbs'][] = ['label' => 'รายเดือน', 'url' => ['smonthlist/smonth']];
$this->params['breadcrumbs'][] = $this->title;

$tyear = '';
$tmonth = '';
$tname = '';
$tdept = '';
$tbank = '';
$tbank_account = '';
$tcid = '';

$user = md5(Yii::$app->user->displayName);
if (isset($_GET['ssn'])) {
    $user = $_GET['ssn'];
    $gyear = $_GET['year'];
    $gmonth = $_GET['mm'];
}


//***********************  เก็บ log *********************





$connection = Yii::$app->db;
//********************** detail รับ*********************
$eyear = intval($gyear) - 543;
echo ($gyear-543).' df'.$gyear;

$sql = "SELECT fyear,fmonth,cid,typesalary,r.money,t.id,t.name,'Yes' AS tcheck,code
FROM p_money_report r
LEFT JOIN p_typemoney t ON t.code=r.typesalary
WHERE fyear='$gyear' AND fmonth='$gmonth' AND md5(cid)='$user' and status='1' and  typesalary <>'money10'
UNION ALL
SELECT YEAR(rs.salarydate),MONTH(rs.salarydate),cid,typesalary,concat(rs.money,'00') as money,ts.id,ts.name,
IF(rs.no LIKE '1%' AND typesalary IN('carry','receive','paid'),'No','Yes') AS tcheck,code
FROM p_money_report_sw rs
LEFT JOIN p_typemoney_sw ts ON ts.code=rs.typesalary
WHERE YEAR(rs.salarydate)='$gyear'-543  AND MONTH(rs.salarydate)='$gmonth' AND md5(rs.cid)='$user'
	AND status='1'
HAVING tcheck='Yes'
ORDER BY id";
$data = $connection->createCommand($sql)
        ->queryAll();
//********************** detail จ่าย*********************
$sqls = "SELECT fyear,fmonth,cid,typesalary,r.money,t.id,t.name,'Yes' AS tcheck,code
FROM p_money_report r
LEFT JOIN p_typemoney t ON t.code=r.typesalary
WHERE fyear='$gyear' AND fmonth='$gmonth' AND md5(cid)='$user' and status='2' and  typesalary <>'money21'
UNION ALL
SELECT YEAR(rs.salarydate),MONTH(rs.salarydate),cid,typesalary,concat(rs.money,'00') as money,ts.id,ts.name,code,
IF(rs.no LIKE '1%' AND typesalary IN('carry','receive','paid'),'No','Yes') AS tcheck
FROM p_money_report_sw rs
LEFT JOIN p_typemoney_sw ts ON ts.code=rs.typesalary
WHERE YEAR(rs.salarydate)='$gyear'-543  AND MONTH(rs.salarydate)='$gmonth' AND md5(rs.cid)='$user'
	AND status='2'
HAVING tcheck='Yes'
ORDER BY id";
$datas = $connection->createCommand($sqls)
        ->queryAll();
//********************** detail จ่าย*********************
$sqlk = "SELECT money
FROM p_money_report r
WHERE fyear='$gyear' AND fmonth='$gmonth' AND md5(cid)='$user'  AND typesalary='total_money'";
$command = Yii::$app->db->createCommand($sqlk);
$total = $command->queryScalar();
//********************* header *******************************
$sqlc = "SELECT s.fyear,t.nmonth,CONCAT(pname,fname,' ',lname) AS tname,s.cid,
	d.deptname as tdept,CONCAT(bank,' ',code_bank) AS tbank,bank_account
FROM p_solary_ver s
LEFT JOIN userinfo uf ON uf.ssn=s.cid
LEFT JOIN dep d ON d.deptid=uf.DEFAULTDEPTID
LEFT JOIN tbmonth t ON t.mm=s.fmonth
WHERE md5(cid)='$user' AND fyear='$gyear' AND fmonth='$gmonth' ";
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
                    <table class="table table-hover">


                        <tr class="success">
                            <td style="center">รายการ</td>
                            <td align="right">จำนวนเงิน/บาท</td> 

                        </tr>
                        <?php $ab = 1;
                        $tsum = 0;
                        ?>
<?php for ($i = 0; $i < sizeof($data); $i++) { ?>

                            <tr>
                                <td><?php echo $ab . '. ' . $data[$i]['name']; ?> </td>
                                <td align="right">
                                    <?php
                                    $tfront = substr($data[$i]['money'], 0, -2);
                                    $tback = substr($data[$i]['money'], -2);
                                    $tmoney = $tfront . '.' . $tback;
                                    echo number_format($tmoney, 2);
                                    ?> 
                                </td> 

                            </tr>


                            <?php
                            $ab++;
                            $tsum = $tsum + $tmoney;
                        }
                        ?>

                        <tr class="danger">
                            <td>รวมรายรับ </td>
                            <td align="right"><?= number_format($tsum, 2); ?> </td> 
                        </tr>



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
                    <table class="table table-hover">


                        <tr class="success">
                            <td style="center">รายการ</td>
                            <td align="right">จำนวนเงิน/บาท</td> 

                        </tr>
                        <?php $ab = 1;  $tsum2 = 0; ?>
                        <?php for ($i = 0; $i < sizeof($datas); $i++) { ?>
                            <tr>
                                <td><?php echo $ab . '. ' . $datas[$i]['name']; ?> </td>
                                <td align="right">
                                    <?php
                                    $tfront = substr($datas[$i]['money'], 0, -2);
                                    $tback = substr($datas[$i]['money'], -2);
                                    $tmoney2 = $tfront . '.' . $tback;
                                    echo number_format($tmoney2, 2);
                                    ?> 
                                </td> 

                            </tr>

                            <?php
                            $ab++;
                            $tsum2 = $tsum2 + $tmoney2;
                        }
                        ?>

                        <tr class="danger">
                            <td>รวมรายการหัก </td>
                            <td align="right"><?= number_format($tsum2, 2); ?> </td> 
                        </tr>




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
                    <h4><?php echo number_format($tsum-$tsum2,2).' บาท'; ?> </h4>

                </div>
            </div> 
        </div>
    </div>


