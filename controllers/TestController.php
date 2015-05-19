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
        $file = "uploads/TEMPPAYROLL_0935473.xls";
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        echo '<table border=1>' . "\n";
        $no = 1;
        $cid = 1;


        foreach ($objWorksheet->getRowIterator() as $row) {

            echo '<tr>' . "\n";
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
            // even if it is not set.
            // By default, only cells
            // that are set will be
            // iterated.
            $no1 = 'A' . $no;
            $cid1 = 'D' . $no;
            $receive = 'I' . $no;
            $paid = 'J' . $no;
            $carry = 'K' . $no;
            $salary = 'L' . $no;
            $tax = 'M' . $no;
            $assur_dd = 'N' . $no;
            $soc = 'S' . $no;
            
            $dno = $objPHPExcel->setActiveSheetIndex(0)->getCell($no1)->getValue();
            $dcid = $objPHPExcel->setActiveSheetIndex(0)->getCell($cid1)->getValue();
            $dreceive = $objPHPExcel->setActiveSheetIndex(0)->getCell($receive)->getValue();
            $dpaid = $objPHPExcel->setActiveSheetIndex(0)->getCell($paid)->getValue();
            $dcarry = $objPHPExcel->setActiveSheetIndex(0)->getCell($carry)->getValue();
            $dsalary = $objPHPExcel->setActiveSheetIndex(0)->getCell($salary)->getValue();
            $dtax = $objPHPExcel->setActiveSheetIndex(0)->getCell($tax)->getValue();
            $dassur_dd = $objPHPExcel->setActiveSheetIndex(0)->getCell($assur_dd)->getValue();
            $dsoc = $objPHPExcel->setActiveSheetIndex(0)->getCell($soc)->getValue();
           
            $no1++;
            $cid1++;
            $receive++;
            $paid++;
            $carry++;
            $salary++;
            $tax++;
            $assur_dd++;
            $soc++;
            
            echo $no1.$cid1;
            
            $mno = $objPHPExcel->setActiveSheetIndex(0)->getCell($no1)->getValue();
            $mcid = $objPHPExcel->setActiveSheetIndex(0)->getCell($cid1)->getValue();
            $mreceive = $objPHPExcel->setActiveSheetIndex(0)->getCell($receive)->getValue();
            $mpaid = $objPHPExcel->setActiveSheetIndex(0)->getCell($paid)->getValue();
            $mcarry = $objPHPExcel->setActiveSheetIndex(0)->getCell($carry)->getValue();
            $msalary = $objPHPExcel->setActiveSheetIndex(0)->getCell($salary)->getValue();
            $mtax = $objPHPExcel->setActiveSheetIndex(0)->getCell($tax)->getValue();
            $massur_dd = $objPHPExcel->setActiveSheetIndex(0)->getCell($assur_dd)->getValue();
            $msoc = $objPHPExcel->setActiveSheetIndex(0)->getCell($soc)->getValue();
            
            
            $type = array($dreceive,$dpaid,$dcarry,$dsalary,$dtax,$dassur_dd,$dsoc);
            $money= array($mreceive,$mpaid,$mcarry,$msalary,$mtax,$massur_dd,$msoc);



            $connection = Yii::$app->db;


            //$this->exec("INSERT IGNORE INTO p_money_report_sw VALUES('$dno','$cid1','$type','$money','$salarydate'");
            $a = 1;
            $i = 0;
            while ($a <= 7) {
                $connection->createCommand("INSERT IGNORE INTO p_money_report_sw VALUES('$dno','$dcid','$type[$i]','$money[$i]','') ")->execute();
                $a++;
                $i++;
            }

        }
        
    }

}
