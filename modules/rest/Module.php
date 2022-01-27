<?php

namespace app\modules\rest;

/**
 * rest module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\rest\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        /*$this->components = [
            'errorHandler' => false,
        ];*/
        /*$this->components = [
            'user' => [
                'identityClass' => 'app\modules\rest\models\User',
                'enableAutoLogin' => false,
                'enableSession' => false,
            ]
        ];*/
        //$this->components['request']['cookieValidationKey'] = false;
        /*$this->components['request']['parsers'] = [
            'application/json' => 'yii\web\JsonParser',
            'text/xml' => 'yii\web\XmlParser',
        ];*/
        /*$this->components['response']['formatters'] = [
            \yii\web\Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter',
                'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            ],
        ];*/
        //$this->components['urlManager']['enableStrictParsing'] = true;


        // custom initialization code goes here
    }
}
