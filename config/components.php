<?php
/**
 * Created by PhpStorm.
 * User: roan
 * Date: 12.12.17
 * Time: 18.45
 *
 * @var \testwork\promo\Module $this
 *
 */

return [
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            [
                'name'      => 'promoApiRule',
                'class'     => 'yii\web\UrlRule',
                'pattern'   => $this->id . '/api',
                'route'     => $this->id . '/api'
            ],
            [
                'name'      => 'promoCrudRule',
                'class'     => 'yii\web\UrlRule',
                'pattern'   => $this->id . '/<action:[\w\-]+>',
                'route'     => $this->id . '/crud/<action>'
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