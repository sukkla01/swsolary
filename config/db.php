<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=192.168.1.113;dbname=dbslip',
    'username' => 'root',
    'password' => '0810432245',
   'charset' => 'utf8',
     'attributes'=>array(
    PDO::MYSQL_ATTR_LOCAL_INFILE=>TRUE
  ),
];
