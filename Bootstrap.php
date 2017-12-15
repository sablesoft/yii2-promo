<?php
/**
 * Created by PhpStorm.
 * User: roan
 * Date: 15.12.17
 * Time: 4.04
 */

namespace testwork\promo;

use yii\base\Event;
use yii\web\Application;
use yii\base\BaseObject;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package testwork\promo
 */
class Bootstrap extends BaseObject implements BootstrapInterface {

    /**
     * @param Application $app
     */
    public function bootstrap( $app ) {
        // check request for promo module:
        $app->on(Application::EVENT_BEFORE_REQUEST, function( Event $event ) {
            /** @var Application $app */
            $app = $event->sender;
            $route = $app->getRequest()->getPathInfo();
            if( preg_match('#^promo*#', $route, $matches ) )
                $this->initPromoUser( $app );
        });
    }

    /**
     * @param Application $app
     */
    protected function initPromoUser( Application $app ) {
        $components = $app->getComponents();
        $userConfig = $components['user'];
        $userConfig = array_merge( $userConfig, require( __DIR__ . '/config/user.php' ) );
        $app->set('user', $userConfig );
    }

}