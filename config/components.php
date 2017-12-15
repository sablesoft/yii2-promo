<?php
/**
 * Created by PhpStorm.
 * User: roan
 * Date: 12.12.17
 * Time: 18.45
 */

use testwork\promo\Bootstrap;
use testwork\promo\models\PromoUser;

return [
    'user' => [
        'identityClass'     => PromoUser::className(),
        'loginUrl'          => ['/promo/login'],
        'identityCookie'    => [
            'name' => '_promoIdentity',
            'httpOnly' => true
        ],
        'idParam'           => '__promoId'
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            [
                'name'      => 'promoApiRule',
                'class'     => 'yii\web\UrlRule',
                'pattern'   => Bootstrap::MODULE_ID . '/api',
                'route'     => Bootstrap::MODULE_ID . '/api'
            ],
            [
                'name'      => 'promoCrudRule',
                'class'     => 'yii\web\UrlRule',
                'pattern'   => Bootstrap::MODULE_ID . '/<action:[\w\-]+>',
                'route'     => Bootstrap::MODULE_ID . '/crud/<action>'
            ],
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => 'promo/api',
                'tokens' => [
                    '{id}'      => '<id:[a-zA-Z0-9\\-]+>'
                ],
                'pluralize' => false
            ]
        ]
    ],
    'request' => [
        'parsers' => [
            'application/json' => 'yii\web\JsonParser'
        ]
    ]
];