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
                              WHERE fyear='2558' AND fmonth='03' AND cid='1100400448316'";

                $datareport = $connection->createCommand($sqlreport)
                        ->queryAll();
                for ($nu = 0; $nu < sizeof($datareport); $nu++) {
                    $fyear = $datareport[$nu]['fyear'];
                    $fmonth = $datareport[$nu]['fmonth'];
                    $cid = $datareport[$nu]['cid'];
                    if ($datareport[$nu]['money1'] > 0) {
                        $tloop = 1;
                    }
                    if ($datareport[$nu]['money10'] > 0) {
                        $tloop = $tloop + 1;
                    }
                    $a = 1;
                    while ($a <= $tloop) {
                          
                        $tmoney='money'.$a;
                        if ($datareport[$nu][$tmoney] > 0) {
                            $money = $datareport[$nu][$tmoney];
                            $typesalary = $tmoney;
                        }
                        $data = $connection->createCommand("INSERT INTO p_money_report VALUES('$fyear','$fmonth','$cid','$a','$typesalary','$money')")->execute();
                        $a++;
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
