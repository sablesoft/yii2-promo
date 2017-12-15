<?php

namespace testwork\promo;

use yii\helpers\ArrayHelper;

/**
 * promo module definition class
 */
class Module extends \yii\base\Module {

    const PROD_MODE = 'production';
    const DEV_MODE  = 'develop';

    /** @var string $mode - module work mode */
    public $mode = 'develop';

    /**
     * @var string the default route of this module. Defaults to `default`.
     * The route may consist of child module ID, controller ID, and/or action ID.
     * For example, `help`, `post/create`, `admin/post/create`.
     * If action ID is not given, it will take the default value as specified in controller
     */
    public $defaultRoute = 'crud';

    /**
     * @var string the namespace that controller classes are in.
     * This namespace will be used to load controller classes by prepending it to the controller
     * class name.
     *
     * If not set, it will use the `controllers` sub-namespace under the namespace of this module.
     * For example, if the namespace of this module is `foo\bar`, then the default
     * controller namespace would be `foo\bar\controllers`.
     *
     * See also the [guide section on autoloading](guide:concept-autoloading) to learn more about
     * defining namespaces and how classes are loaded.
     */
    public $controllerNamespace = 'testwork\promo\controllers';

    /**
     * Initializes the module.
     *
     * Set promo module alias and update app components
     *
     * This method is called after the module is created and initialized with property values
     * given in configuration. The default implementation will initialize [[controllerNamespace]]
     * if it is not set.
     *
     * If you override this method, please make sure you call the parent implementation.
     */
    public function init() {
        parent::init();
        $this->aliasesInit();
        $this->updateAppComponents();
    }

    /**
     * Production mode checker
     *
     * @return bool
     */
    public function isProduction() {
        return $this->mode === self::PROD_MODE;
    }

    /**
     * Set module aliases
     *
     * @return void
     */
    protected function aliasesInit() {
        // retrieve aliases paths:
        $vendor = '@app/vendors/testwork/promo';
        $alias = ( $this->isProduction() )?
            $vendor : '@app/modules/promo';
        // set alias:
        \Yii::setAlias('@promo', $alias );
    }

    /**
     * Update main app components
     *
     * @return void
     *
     */
    protected function updateAppComponents() {
        $components = require(__DIR__ . '/config/components.php');
        $appComponents = \Yii::$app->getComponents();
        $appComponents = ArrayHelper::merge( $appComponents, $components );
        \Yii::$app->setComponents( $appComponents );
    }

}
