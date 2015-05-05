<?php

namespace app\controllers;

use yii;
use yii\data\ArrayDataProvider;

class FinsearchController extends \yii\web\Controller {

    public function actionIndex() {
        $connection = Yii::$app->db;
        $sql = "select 1 as cc";
        $cid = '';
       


        if (Yii::$app->request->isPost) {

            if ($_POST['cid'] <> '') {
                $cid = $_POST['cid'];
                $sql = "SELECT ssn,name,d.DEPTNAME FROM userinfo u LEFT JOIN dep d ON d.DEPTID=u.DEFAULTDEPTID WHERE ssn='$cid'";
            } else if ($_POST['tname'] <> '') {
                $name = $_POST['tname'];
                $sql = "SELECT ssn,name,d.DEPTNAME FROM userinfo u LEFT JOIN dep d ON d.DEPTID=u.DEFAULTDEPTID WHERE name LIKE '%$name%'";
            } else {
                $sql = "SELECT ssn,name,d.DEPTNAME FROM userinfo u LEFT JOIN dep d ON d.DEPTID=u.DEFAULTDEPTID WHERE ssn='111111111'";
            }
        }
        $data = $connection->CreateCommand($sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}
