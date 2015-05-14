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
        $money = '';
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
                              WHERE d_update='$tdate' ";

                $datareport = $connection->createCommand($sqlreport)
                        ->queryAll();

                for ($nu = 0; $nu < sizeof($datareport); $nu++) {
                    $tmoney1 = NULL;
                    $fyear = $datareport[$nu]['fyear'];
                    $fmonth = $datareport[$nu]['fmonth'];
                    $cid = $datareport[$nu]['cid'];
                    $tname = $datareport[$nu]['pname'] . $datareport[$nu]['fname'] . ' ' . $datareport[$nu]['lname'];
                    $solary = $datareport[$nu]['solary'];
                    $money1 = $datareport[$nu]['money1'];
                    $money2 = $datareport[$nu]['money2'];
                    $money3 = $datareport[$nu]['money3'];
                    $money4 = $datareport[$nu]['money4'];
                    $money5 = $datareport[$nu]['money5'];
                    $money6 = $datareport[$nu]['money6'];
                    $money7 = $datareport[$nu]['money7'];
                    $money8 = $datareport[$nu]['money8'];
                    $money9 = $datareport[$nu]['money9'];
                    $money10 = $datareport[$nu]['money10'];
                    $money11 = $datareport[$nu]['money11'];
                    $money12 = $datareport[$nu]['money12'];
                    $money13 = $datareport[$nu]['money13'];
                    $money14 = $datareport[$nu]['money14'];
                    $money15 = $datareport[$nu]['money15'];
                    $money16 = $datareport[$nu]['money16'];
                    $money17 = $datareport[$nu]['money17'];
                    $money18 = $datareport[$nu]['money18'];
                    $money19 = $datareport[$nu]['money19'];
                    $money20 = $datareport[$nu]['money20'];
                    $money21 = $datareport[$nu]['money21'];
                    $total_money = $datareport[$nu]['total_money'];


                    $tsolary = 'solary';
                    $tmoney1 = 'money1';
                    $tmoney2 = 'money2';
                    $tmoney3 = 'money3';
                    $tmoney4 = 'money4';
                    $tmoney5 = 'money5';
                    $tmoney6 = 'money6';
                    $tmoney7 = 'money7';
                    $tmoney8 = 'money8';
                    $tmoney9 = 'money9';
                    $tmoney10 = 'money10';
                    $tmoney11 = 'money11';
                    $tmoney12 = 'money12';
                    $tmoney13 = 'money13';
                    $tmoney14 = 'money14';
                    $tmoney15 = 'money15';
                    $tmoney16 = 'money16';
                    $tmoney17 = 'money17';
                    $tmoney18 = 'money18';
                    $tmoney19 = 'money19';
                    $tmoney20 = 'money20';
                    $tmoney21 = 'money21';
                    $ttotal_money = 'total_money';




                    $money = array($solary, $money1, $money2, $money3, $money4, $money5, $money6, $money7, $money8,
                        $money9, $money10, $money11, $money12, $money13, $money14, $money15, $money16,
                        $money17, $money18, $money19, $money20, $money21, $total_money);

                    $type = array($tsolary, $tmoney1, $tmoney2, $tmoney3, $tmoney4, $tmoney5, $tmoney6, $tmoney7, $tmoney8,
                        $tmoney9, $tmoney10, $tmoney11, $tmoney12, $tmoney13, $tmoney14, $tmoney15, $tmoney16,
                        $tmoney17, $tmoney18, $tmoney19, $tmoney20, $tmoney21, $ttotal_money);


                    $a = 1;
                    $i = 0;
                    while ($a <= 23) {
                        $data = $connection->createCommand("INSERT IGNORE INTO p_money_report VALUES('$fyear','$fmonth','$cid','$i','$type[$i]','$money[$i]')")->execute();
                        $a++;
                        $i++;
                    }
                }
                $data = $connection->createCommand("DELETE FROM p_money_report WHERE money=0 ")->execute();
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


        return $this->render('upload', ['model' => $model, 'money' => $money]);
    }

    public function actionUploadsw() {
        $model = new UploadForm;
        
        if (Yii::$app->request->isPost) {
            $connection = Yii::$app->db;
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $model->file->saveAs(
                        'uploads/' . $model->file->baseName . '.' . $model->file->extension);
                $path = $model->file->baseName . '.' . $model->file->extension;
                $sql = "LOAD DATA LOCAL INFILE 'uploads/$path' REPLACE INTO TABLE p_salary_sw
                    FIELDS TERMINATED BY ',' 
                    ENCLOSED BY '\"' 
                    LINES TERMINATED BY '\r\n' 
                    IGNORE 1 LINES  ";
                $data = $connection->createCommand($sql)->execute();
                
              Yii::$app->session->setFlash('material-green-400', 'อัพโหลดไฟล์เรียบร้อยแล้ว');
            } else {
                Yii::$app->session->setFlash('danger', 'ไม่สามารถอัพโหลดไฟล์ได้ หรือยังไม่ได้เลือกไฟล์ กรุณาติดต่อเจ้าหน้าที่ไอที');
            }
        }
        return $this->render('uploadsw',['model'=>$model]);
    }

}
