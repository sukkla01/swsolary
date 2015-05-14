<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use Yii;
use yii\data\ArrayDataProvider;

class SmonthlistController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionSmonth() {

        function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

       

        $agent = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('/Linux/', $agent))
            $os = 'Linux';
        elseif (preg_match('/Win/', $agent))
            $os = 'Windows';
        elseif (preg_match('/Mac/', $agent))
            $os = 'Mac';
        else
            $os = 'UnKnown';

      


$user = Yii::$app->user->displayName;
if(isset($_GET['ssn'])){
    $user=$_GET['ssn'];
}
$tdate = date('Y-m-d H:i:s');
$log_code = generateRandomString();

$connection = Yii::$app->db;
$sql = "SELECT fyear,fmonth,nmonth,cid
FROM p_solary_ver s
LEFT JOIN tbmonth t ON t.mm=s.fmonth
WHERE cid='$user'
GROUP BY nmonth
ORDER BY fyear,fmonth DESC";
$data = $connection->createCommand($sql)
->queryAll();
$dataProvider = new ArrayDataProvider([
'allModels' => $data,
'pagination' => [
'pageSize' => 10
]
]);

$data = $connection->createCommand("INSERT INTO p_log VALUES ('$log_code','smonthlist','$user','','','$os','$tdate') ")->execute();

return $this->render('smonth', ['dataProvider' => $dataProvider]);
}

public function actionSmonth_cid() {

function generateRandomString1($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

$agent = $_SERVER['HTTP_USER_AGENT'];

        if (preg_match('/Linux/', $agent))
            $os = 'Linux';
        elseif (preg_match('/Win/', $agent))
            $os = 'Windows';
        elseif (preg_match('/Mac/', $agent))
            $os = 'Mac';
        else
            $os = 'UnKnown';

$ldate = date('Y-m-d H:i:s');
$user = Yii::$app->user->displayName;
$gyear = $_GET['year'];
$gmonth = $_GET['mm'];
//$log_code = 'log' . rand(0, 100000000) . 'sw';
$log_code=generateRandomString1();

$connection = Yii::$app->db;

$data = $connection->createCommand("INSERT IGNORE INTO p_log VALUES ('$log_code','smonthdetail','$user','$gyear','$gmonth','$os','$ldate') ")->execute();
return $this->render('smonth_cid');
}

public function actionSearchsmonth() {
    $connection = Yii::$app->db;
    $ssn=$_GET['ssn'];
    $sql="SELECT CONCAT(nmonth,' ', fyear) AS tname,fmonth,cid,fyear
            FROM p_solary_ver s
            LEFT JOIN tbmonth t ON t.mm=s.fmonth
            WHERE cid='$ssn'
            GROUP BY nmonth
            ORDER BY fyear,fmonth DESC";
    $data = $connection->CreateCommand($sql)->queryAll();
    $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
     ]);

    
    return $this->render('searchsmonth',['dataProvider'=>$dataProvider]);
    
}
public function actionSmonth_cid1() {
    
    return $this->render('smonth_cid1');
    
}


}
