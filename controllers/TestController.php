<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionTest2() {
        $file = "/uploads/TEMPPAYROLL_0935473.xls";
        $objReader = PHPExcel_IOFactory::createReader('Excel2003');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($file);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
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
}
