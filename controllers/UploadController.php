<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;

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
                $data = $connection->createCommand("UPDATE  p_solary_ver SET fyear=YEAR(d_update)+543 WHERE fyear=0 ")->execute();
                $data = $connection->createCommand("UPDATE  p_money_report SET fyear=YEAR(curdate())+543 WHERE fyear=0 ")->execute();
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
            $date1 = date('Y-m-d');
         if (Yii::$app->request->isPost) {
            $date1 = $_POST['date1'];
            
        }
        
        if (Yii::$app->request->isPost) {
            $connection = Yii::$app->db;
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) {
                $model->file->saveAs(
                        'uploads/' . $model->file->baseName . '.' . $model->file->extension);
                $path = $model->file->baseName . '.' . $model->file->extension;

                //echo $path;
                //**********************  insert report *****************************
                $file = "uploads/".$path;
                $inputFileType = PHPExcel_IOFactory::identify($file);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objReader->setReadDataOnly(true);
                $objPHPExcel = $objReader->load($file);
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $no = 1;
                $cid = 1;

                foreach ($objWorksheet->getRowIterator() as $row) {


                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,

                    $no1 = 'A' . $no;
                    $cid1 = 'D' . $no;
                    $receive = 'I' . $no;
                    $paid = 'J' . $no;
                    $carry = 'K' . $no;
                    $salary = 'L' . $no;
                    $tax = 'M' . $no;
                    $assur_dd = 'N' . $no;
                    $soc = 'S' . $no;
                    $type1 = 'T' . $no;
                    $type2 = 'U' . $no;
                    $type3 = 'V' . $no;
                    $type4 = 'W' . $no;
                    $type5 = 'X' . $no;
                    $type6 = 'Y' . $no;
                    $type7 = 'Z' . $no;
                    $type8 = 'AA' . $no;
                    $type9 = 'AB' . $no;
                    $type10 = 'AC' . $no;
                    $type11 = 'AD' . $no;
                    $type12 = 'AE' . $no;
                    $type13 = 'AF' . $no;
                    $type14 = 'AG' . $no;
                    $type15 = 'AH' . $no;
                    $type16 = 'AI' . $no;
                    $type17 = 'AJ' . $no;
                    $type18 = 'AK' . $no;
                    $type19 = 'AL' . $no;
                    $type20 = 'AJ' . $no;
                    $type21 = 'AM' . $no;
                    $type22 = 'AN' . $no;
                    $type23 = 'AO' . $no;
                    $type24 = 'AP' . $no;
                    $type25 = 'AQ' . $no;
                    $type26 = 'AR' . $no;
                    $type27 = 'AS' . $no;
                    $type28 = 'AT' . $no;



                    if ($no == 1) {
                        $dno = $objPHPExcel->setActiveSheetIndex(0)->getCell($no1)->getValue();
                        $dcid = $objPHPExcel->setActiveSheetIndex(0)->getCell($cid1)->getValue();
                        $dreceive = $objPHPExcel->setActiveSheetIndex(0)->getCell($receive)->getValue();
                        $dpaid = $objPHPExcel->setActiveSheetIndex(0)->getCell($paid)->getValue();
                        $dcarry = $objPHPExcel->setActiveSheetIndex(0)->getCell($carry)->getValue();
                        $dsalary = $objPHPExcel->setActiveSheetIndex(0)->getCell($salary)->getValue();
                        $dtax = $objPHPExcel->setActiveSheetIndex(0)->getCell($tax)->getValue();
                        $dassur_dd = $objPHPExcel->setActiveSheetIndex(0)->getCell($assur_dd)->getValue();
                        $dsoc = $objPHPExcel->setActiveSheetIndex(0)->getCell($soc)->getValue();
                        $dtype1 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type1)->getValue();
                        $dtype2 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type2)->getValue();
                        $dtype3 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type3)->getValue();
                        $dtype4 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type4)->getValue();
                        $dtype5 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type5)->getValue();
                        $dtype6 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type6)->getValue();
                        $dtype7 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type7)->getValue();
                        $dtype8 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type8)->getValue();
                        $dtype9 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type9)->getValue();
                        $dtype10 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type10)->getValue();
                        $dtype11 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type11)->getValue();
                        $dtype12 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type12)->getValue();
                        $dtype13 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type13)->getValue();
                        $dtype14 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type14)->getValue();
                        $dtype15 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type15)->getValue();
                        $dtype16 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type16)->getValue();
                        $dtype17 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type17)->getValue();
                        $dtype18 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type18)->getValue();
                        $dtype19 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type19)->getValue();
                        $dtype20 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type20)->getValue();
                        $dtype21 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type21)->getValue();
                        $dtype22 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type22)->getValue();
                        $dtype23 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type23)->getValue();
                        $dtype24 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type24)->getValue();
                        $dtype25 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type25)->getValue();
                        $dtype26 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type26)->getValue();
                        $dtype27 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type27)->getValue();
                        $dtype28 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type28)->getValue();
                    }
                    $no1++;
                    $cid1++;
                    $receive++;
                    $paid++;
                    $carry++;
                    $salary++;
                    $tax++;
                    $assur_dd++;
                    $soc++;
                    $type1++;
                    $type2++;
                    $type3++;
                    $type4++;
                    $type5++;
                    $type6++;
                    $type7++;
                    $type8++;
                    $type9++;
                    $type10++;
                    $type11++;
                    $type12++;
                    $type13++;
                    $type14++;
                    $type15++;
                    $type16++;
                    $type17++;
                    $type18++;
                    $type19++;
                    $type20++;
                    $type21++;
                    $type22++;
                    $type23++;
                    $type24++;
                    $type25++;
                    $type26++;
                    $type27++;
                    $type28++;



                    $mno = $objPHPExcel->setActiveSheetIndex(0)->getCell($no1)->getValue();
                    $mcid = $objPHPExcel->setActiveSheetIndex(0)->getCell($cid1)->getValue();
                    $mreceive = $objPHPExcel->setActiveSheetIndex(0)->getCell($receive)->getValue();
                    $mpaid = $objPHPExcel->setActiveSheetIndex(0)->getCell($paid)->getValue();
                    $mcarry = $objPHPExcel->setActiveSheetIndex(0)->getCell($carry)->getValue();
                    $msalary = $objPHPExcel->setActiveSheetIndex(0)->getCell($salary)->getValue();
                    $mtax = $objPHPExcel->setActiveSheetIndex(0)->getCell($tax)->getValue();
                    $massur_dd = $objPHPExcel->setActiveSheetIndex(0)->getCell($assur_dd)->getValue();
                    $msoc = $objPHPExcel->setActiveSheetIndex(0)->getCell($soc)->getValue();
                    $mtype1 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type1)->getValue();
                    $mtype2 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type2)->getValue();
                    $mtype3 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type3)->getValue();
                    $mtype4 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type4)->getValue();
                    $mtype5 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type5)->getValue();
                    $mtype6 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type6)->getValue();
                    $mtype7 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type7)->getValue();
                    $mtype8 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type8)->getValue();
                    $mtype9 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type9)->getValue();
                    $mtype10 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type10)->getValue();
                    $mtype11 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type11)->getValue();
                    $mtype12 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type12)->getValue();
                    $mtype13 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type13)->getValue();
                    $mtype14 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type14)->getValue();
                    $mtype15 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type15)->getValue();
                    $mtype16 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type16)->getValue();
                    $mtype17 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type17)->getValue();
                    $mtype18 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type18)->getValue();
                    $mtype19 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type19)->getValue();
                    $mtype20 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type20)->getValue();
                    $mtype21 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type21)->getValue();
                    $mtype22 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type22)->getValue();
                    $mtype23 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type23)->getValue();
                    $mtype24 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type24)->getValue();
                    $mtype25 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type25)->getValue();
                    $mtype26 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type26)->getValue();
                    $mtype27 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type27)->getValue();
                    $mtype28 = $objPHPExcel->setActiveSheetIndex(0)->getCell($type28)->getValue();



                    $type = array($dreceive, $dpaid, $dcarry, $dsalary, $dtax, $dassur_dd, $dsoc, $dtype1, $dtype2, $dtype3, $dtype4, $dtype5, $dtype6, $dtype7, $dtype8,
                        $dtype9, $dtype10, $dtype11, $dtype12, $dtype13, $dtype14, $dtype15, $dtype16, $dtype17, $dtype18, $dtype19, $dtype20, $dtype21, $dtype22,
                        $dtype23, $dtype24, $dtype25, $dtype26, $dtype27, $dtype28);

                    $money = array($mreceive, $mpaid, $mcarry, $msalary, $mtax, $massur_dd, $msoc, $mtype1, $mtype2, $mtype3, $mtype4, $mtype5, $mtype6, $mtype7, $mtype8,
                        $mtype9, $mtype10, $mtype11, $mtype12, $mtype13, $mtype14, $mtype15, $mtype16, $mtype17, $mtype18, $mtype19, $mtype20, $mtype21, $mtype22,
                        $mtype23, $mtype24, $mtype25, $mtype26, $mtype27, $mtype28);



                    $connection = Yii::$app->db;


                    //$this->exec("INSERT IGNORE INTO p_money_report_sw VALUES('$dno','$cid1','$type','$money','$salarydate'");
                    $a = 1;
                    $i = 0;
                    while ($a <= 35) {
                        $connection->createCommand("INSERT IGNORE INTO p_money_report_sw VALUES('$mno','$mcid','$type[$i]','$money[$i]','$date1') ")->execute();
                        //echo $mno . ' ' . $mcid . ' ' . $type[$i] . ' ' . $money[$i] . '<br>';
                        $a++;
                        $i++;
                    }



                    $no++;
                }

                $connection->createCommand("DELETE FROM p_money_report_sw WHERE (no='' AND cid='') OR money=0 ")->execute();
                //********************** end  insert report *****************************



                Yii::$app->session->setFlash('material-green-400', 'อัพโหลดไฟล์เรียบร้อยแล้ว');
            } else {
                Yii::$app->session->setFlash('danger', 'ไม่สามารถอัพโหลดไฟล์ได้ หรือยังไม่ได้เลือกไฟล์ กรุณาติดต่อเจ้าหน้าที่ไอที');
            }
        }
        return $this->render('uploadsw', ['model' => $model, 'date1' => $date1]);
    }

}
