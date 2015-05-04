<?php

namespace app\controllers;
use yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\data\ArrayDataProvider;

class LogshowController extends \yii\web\Controller {

    public function actionIndex() {

        $sql = "SELECT l.user,u.name,detail,lyear,lmonth,os,lastdate
                FROM p_log l
                LEFT JOIN userinfo u ON u.SSN=l.user
                Order By lastdate DESC";
        
        $connection = Yii::$app->db;
        $data = $connection->createCommand($sql)
                ->queryAll();
         $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            /*'pagination'=>[
                'pageSize'=>2
            ]*/
        ]);
        
        
        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
