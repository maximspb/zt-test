<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=zt-test', //@todo: заменить на переменные при сборке
    'username' => 'homestead', //@todo: заменить на переменные при сборке
    'password' => 'secret', //@todo: заменить на переменные при сборке
    'charset' => 'utf8',
    'attributes' => [PDO::MYSQL_ATTR_LOCAL_INFILE => true],

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
