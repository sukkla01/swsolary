<?php

namespace app\controllers;

use yii;
use yii\data\ArrayDataProvider;
class FinsearchController extends \yii\web\Controller {

    public function actionIndex() {
        $connection = Yii::$app->db;
        $sql="select 1 as cc";
        $cid='';
        
        
        
        if (Yii::$app->request->isPost) {
            
            if (isset($_POST['cid'])) {
                $cid=$_POST['cid'];
                $sql = "SELECT ssn,name FROM userinfo WHERE ssn='$cid'";
                
            }
            
            
        }
        $data = $connection->CreateCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);

        return $this->render('index',['dataProvider'=>$dataProvider]);
    }

}
