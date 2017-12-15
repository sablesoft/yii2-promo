<?php

namespace testwork\promo;

/**
 * promo module definition class
 */
class Module extends \yii\base\Module {

    /**
     * @var string the default route of this module. Defaults to `default`.
     * The route may consist of child module ID, controller ID, and/or action ID.
     * For example, `help`, `post/create`, `admin/post/create`.
     * If action ID is not given, it will take the default value as specified in controller
     */
    public $defaultRoute = 'crud';

}
