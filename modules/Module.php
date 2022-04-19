<?php
namespace modules;

use Craft;
use yii\base\Module as BaseModule;

/**
 * Custom Module Class
 * 
 * Heroku has no special requirements for custom modules. Do be conscious of the stack's tendency to upgrade your PHP version when deploying—if you have really specific constraints on where your code will work, be sure and declare it in composer.json!
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@modules', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\controllers';
        }

        parent::init();

        // Custom initialization code goes here...
    }
}
