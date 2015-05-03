<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use Yii;
use yii\data\ArrayDataProvider;



class SmonthlistController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionSmonth()
    {
        $connection = Yii::$app->db;
        $sql="SELECT fyear,fmonth,nmonth,cid
                FROM p_solary_ver s
                LEFT JOIN tbmonth t ON t.mm=s.fmonth
                WHERE cid='3540500002738'
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
        return $this->render('smonth',['dataProvider'=>$dataProvider]);
    }
    
    public function actionSmonth_cid()
    {
        //$sql="SELECT * FROM p_solary_ver WHERE cid='3540500002738'";
        
        
        return $this->render('smonth_cid');
    }


}
