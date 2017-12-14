<?php
/**
 * Created by PhpStorm.
 * User: roan
 * Date: 14.12.17
 * Time: 18.19
 */

use testwork\promo\models\PromoUser;

return [
    'identityClass'     => PromoUser::className(),
    'loginUrl'          => ['/promo/login'],
    'identityCookie'    => [
        'name' => '_promoIdentity',
        'httpOnly' => true
    ],
    'idParam'           => '__promoId'
];