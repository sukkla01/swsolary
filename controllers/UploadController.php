<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

class UploadController extends Controller {

    public function actionUpload() {
        $model = new UploadForm;
        $connection = Yii::$app->db;
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $model->file->saveAs(
                        'uploads/' . $model->file->baseName . '.' . $model->file->extension);
                $path = $model->file->baseName . '.' . $model->file->extension;
                $sql = "LOAD DATA LOCAL INFILE 'uploads/$path' REPLACE INTO TABLE p_solary_ver
                    FIELDS TERMINATED BY '$' 
                    ENCLOSED BY '\"' 
                    LINES TERMINATED BY '\r\n' ";

                $data = $connection->createCommand($sql)->execute();
                $tdate = date('Y-m-d H:i:s');
                $data = $connection->createCommand("update p_solary_ver set d_update='$tdate' where d_update is null")->execute();

                //**********************  insert report *****************************
                $sqlreport = "SELECT * 
                              FROM  p_solary_ver
                              WHERE fyear='2558' AND fmonth='03' AND cid IN('1100400448316','1101401875626')";

                $datareport = $connection->createCommand($sqlreport)
                        ->queryAll();
                for ($nu = 0; $nu < sizeof($datareport); $nu++) {
                    $fyear = $datareport[$nu]['fyear'];
                    $fmonth = $datareport[$nu]['fmonth'];
                    $cid = $datareport[$nu]['cid'];
                    $tname=$datareport[$nu]['pname'].$datareport[$nu]['fname'].' '.$datareport[$nu]['lname'];
                     if ($datareport[$nu]['solary'] > 0) {
                        $tloop = 1;
                        $money[]=$datareport[$nu]['solary'];
                        $type[]='solary';
                    }
                    if ($datareport[$nu]['money1'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money1'];
                        $type[]='money1';
                    }
                    if ($datareport[$nu]['money2'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money2'];
                         $type[]='money2';
                    }
                    if ($datareport[$nu]['money3'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money3'];
                         $type[]='money3';
                    }
                    if ($datareport[$nu]['money4'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money4'];
                         $type[]='money4';
                    }
                    if ($datareport[$nu]['money5'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money5'];
                         $type[]='money5';
                    }
                    if ($datareport[$nu]['money6'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money6'];
                         $type[]='money6';
                    }if ($datareport[$nu]['money7'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money7'];
                         $type[]='money7';
                    }
                    if ($datareport[$nu]['money8'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money8'];
                         $type[]='money8';
                    }
                    if ($datareport[$nu]['money9'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money9'];
                         $type[]='money9';
                    }
                    if ($datareport[$nu]['money10'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money10'];
                         $type[]='money10';
                    }
                    if ($datareport[$nu]['money11'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money11'];
                         $type[]='money11';
                    }
                    if ($datareport[$nu]['money12'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money12'];
                         $type[]='money12';
                    }
                    if ($datareport[$nu]['money13'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money13'];
                         $type[]='money13';
                    }
                    if ($datareport[$nu]['money14'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money14'];
                         $type[]='money14';
                    }
                    if ($datareport[$nu]['money15'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money15'];
                         $type[]='money15';
                    }
                    if ($datareport[$nu]['money16'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money16'];
                         $type[]='money16';
                    }
                    if ($datareport[$nu]['money17'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money17'];
                         $type[]='money17';
                    }
                    if ($datareport[$nu]['money18'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money18'];
                         $type[]='money18';
                    }
                    if ($datareport[$nu]['money19'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money19'];
                         $type[]='money19';
                    }
                    if ($datareport[$nu]['money20'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money20'];
                         $type[]='money20';
                    }
                    if ($datareport[$nu]['money21'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['money21'];
                         $type[]='money21';
                    }
                    if ($datareport[$nu]['total_money'] > 0) {
                        $tloop = $tloop + 1;
                        $money[]=$datareport[$nu]['total_money'];
                         $type[]='total_money';
                    }
                    $a = 1;
                    $i=0;
                    while ($a <= $tloop) {
                        $data = $connection->createCommand("INSERT INTO p_money_report VALUES('$fyear','$fmonth','$cid','$tname','$type[$i]','$money[$i]')")->execute();
                        $a++;
                        $i++;
                    }
                }
                //**********************  end report ********************************

                Yii::$app->session->setFlash('material-green-400', 'อัพโหลดไฟล์เรียบร้อยแล้ว');
            } else {
                Yii::$app->session->setFlash('danger', 'ไม่สามารถอัพโหลดไฟล์ได้ หรือยังไม่ได้เลือกไฟล์ กรุณาติดต่อเจ้าหน้าที่ไอที');
            }
        }
        /* Yii::$app->session->setFlash('success', 'สำเร็จ');
          Yii::$app->session->setFlash('info', 'ข้อมูลเพิ่มเติม');
          Yii::$app->session->setFlash('warning', 'เตือน');
          Yii::$app->session->setFlash('danger', 'อันตราย');
          Yii::$app->session->setFlash('default', 'ปกติ'); */


        return $this->render('upload', ['model' => $model]);
    }

}
