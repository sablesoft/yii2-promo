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
use yii\helpers\ArrayHelper;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package testwork\promo
 */
class Bootstrap extends BaseObject implements BootstrapInterface {

    const MODULE_ID = 'promo';

    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app - the application currently running
     * @return void
     */
    public function bootstrap( $app ) {
        // append promo module to app:
        $app->setModule(self::MODULE_ID, ['class' => 'testwork\promo\Module' ]);
        // check web request for promo module:
        if( $app instanceof Application )
            $this->bootstrapWeb( $app );
        elseif( $app instanceof \yii\console\Application )
            $this->bootstrapConsole( $app );
    }

    /**
     * Bootstrap web app
     *
     * @param Application $app
     * @return void
     */
    protected function bootstrapWeb( Application $app ) {
        $app->on(Application::EVENT_BEFORE_REQUEST, function( Event $event ) {
            /** @var Application $app */
            $app = $event->sender;
            $route = $app->getRequest()->getPathInfo();
            if( preg_match('#^promo*#', $route, $matches ) )
                $this->updateWebComponents( $app );
        });
    }

    /**
     * Update web app components
     *
     * @param Application $app
     * @return void
     */
    protected function updateWebComponents( Application $app ) {
        // load components for promo module working:
        $components = require(__DIR__ . '/config/components.php');
        // load current app components:
        $appComponents = $app->getComponents();
        // merging and set:
        $appComponents = ArrayHelper::merge( $appComponents, $components );
        $app->setComponents( $appComponents );
    }

    /**
     * Bootstrap console app
     *
     * @param \yii\console\Application $app
     * @return void
     */
    protected function bootstrapConsole( \yii\console\Application $app ) {
        // get migration map:
        $map = require(__DIR__ . '/config/migration.php');
        $appMap = ( $app->controllerMap ) ?: [];
        // set merged migration map:
        $app->controllerMap = ArrayHelper::merge( $appMap, $map );
    }

}