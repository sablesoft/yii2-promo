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

}