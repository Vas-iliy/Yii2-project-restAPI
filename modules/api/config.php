<?php
return [
    'components' => [
        'urlManager' => [
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['api/user', 'api/new'],
                    'pluralize' => false,
                ]
            ]
        ]
    ]
];