<?php
/**
 * Created by PhpStorm.
 * User: roan
 * Date: 15.12.17
 * Time: 8.42
 */

return [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [
            'app\migrations',
            'testwork\promo\migrations'
        ]
    ]
];