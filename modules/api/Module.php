<?php

namespace app\modules\api;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        /*$this->components = [
            'request' => []
        ];*/

        //\Yii::configure($this, require __DIR__ . '/config.php');

        // custom initialization code goes here
    }
}
