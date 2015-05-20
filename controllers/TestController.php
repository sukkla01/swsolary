<?php

namespace app\controllers;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;
use yii;

class TestController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionTest2() {
        $file = "uploads/ot_jan58.xls";
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        echo '<table border=1>' . "\n";
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
            
            
            
            if($no==1){
            $dno = $objPHPExcel->setActiveSheetIndex(0)->getCell($no1)->getValue();
            $dcid = $objPHPExcel->setActiveSheetIndex(0)->getCell($cid1)->getValue();
            $dreceive = $objPHPExcel->setActiveSheetIndex(0)->getCell($receive)->getValue();
            $dpaid = $objPHPExcel->setActiveSheetIndex(0)->getCell($paid)->getValue();
            $dcarry = $objPHPExcel->setActiveSheetIndex(0)->getCell($carry)->getValue();
            $dsalary = $objPHPExcel->setActiveSheetIndex(0)->getCell($salary)->getValue();
            $dtax = $objPHPExcel->setActiveSheetIndex(0)->getCell($tax)->getValue();
            $dassur_dd = $objPHPExcel->setActiveSheetIndex(0)->getCell($assur_dd)->getValue();
            $dsoc = $objPHPExcel->setActiveSheetIndex(0)->getCell($soc)->getValue();
             $dtype1 =$objPHPExcel->setActiveSheetIndex(0)->getCell($type1)->getValue();
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
            $mtype1 =$objPHPExcel->setActiveSheetIndex(0)->getCell($type1)->getValue();
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
            
            
            
            $type = array($dreceive,$dpaid,$dcarry,$dsalary,$dtax,$dassur_dd,$dsoc,$dtype1,$dtype2,$dtype3,$dtype4,$dtype5,$dtype6,$dtype7,$dtype8,
                          $dtype9,$dtype10,$dtype11,$dtype12,$dtype13,$dtype14,$dtype15,$dtype16,$dtype17,$dtype18,$dtype19,$dtype20,$dtype21,$dtype22,
                          $dtype23,$dtype24,$dtype25,$dtype26,$dtype27,$dtype28 );
            
            $money= array($mreceive,$mpaid,$mcarry,$msalary,$mtax,$massur_dd,$msoc,$mtype1,$mtype2,$mtype3,$mtype4,$mtype5,$mtype6,$mtype7,$mtype8,
                          $mtype9,$mtype10,$mtype11,$mtype12,$mtype13,$mtype14,$mtype15,$mtype16,$mtype17,$mtype18,$mtype19,$mtype20,$mtype21,$mtype22,
                          $mtype23,$mtype24,$mtype25,$mtype26,$mtype27,$mtype28);


             
            $connection = Yii::$app->db;


            //$this->exec("INSERT IGNORE INTO p_money_report_sw VALUES('$dno','$cid1','$type','$money','$salarydate'");
            $a = 1;
            $i = 0;
            while ($a <= 35) {
               $connection->createCommand("INSERT IGNORE INTO p_money_report_sw VALUES('$mno','$mcid','$type[$i]','$money[$i]','') ")->execute();
               echo  $mno.' '.$mcid.' '.$type[$i].' '.$money[$i].'<br>';
                $a++;
                $i++;
            }
            
            
            
            $no++;

        }
            
        $connection->createCommand("DELETE FROM p_money_report_sw WHERE (no='' AND cid='') OR money=0 ")->execute();
    }
    
    public function actionTest3() {
         $file = "uploads/TEMPPAYROLL_0935473.xls";
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        //echo "<pre>";
        //print_r($objWorksheet->getRowIterator()->current());
//objWorksheet = $objPHPExcel->getActiveSheet();
        echo '<table border=1>' . "\n";
        foreach ($objWorksheet->getRowIterator() as $row) {
            echo '<tr>' . "\n";
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set.
            // By default, only cells
            // that are set will be
            // iterated.
            foreach ($cellIterator as $cell) {
                $data = $cell->getCalculatedValue();
                if ($data == "#DIV/0!") {
                    $data = 0;
                };
                echo '<td>' . $data . '</td>' . "\n";
            }
            echo '</tr>' . "\n";
        }
        echo '</table>' . "\n";
    }
    
    
    
    public function getTableColumn($table) {
        $sql = "SHOW COLUMNS FROM $table";
        //$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'data_pcu';";
        $raw = Yii::$app->db->createCommand($sql)->queryAll();
        $cols = [];
        foreach ($raw as $value) {
            $cols[] = $value['Field'];
        }
        //print_r($cols);
        return $cols;
    }

}
