<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=dbslip',
    'username' => 'root',
    'password' => '',
   'charset' => 'utf8',
     'attributes'=>array(
    PDO::MYSQL_ATTR_LOCAL_INFILE=>TRUE
  ),
];
