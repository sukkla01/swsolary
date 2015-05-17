<?php

namespace app\controllers;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $sql = "select email from user where username='neo' ";
        $mail=\Yii::$app->db->createCommand($sql)->queryScalar();
        print_r($mail);
    }
}
