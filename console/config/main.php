<?php

$params = array_merge_recursive(
    require __DIR__ . '/../../common/config/params.php',
    (file_exists(__DIR__ . '/../../common/config/params-local.php') ? require __DIR__ . '/../../common/config/params-local.php' : []),
    require __DIR__ . '/params.php',
    (file_exists(__DIR__ . '/params-local.php') ? require __DIR__ . '/params-local.php' : [])
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'fixture' => [
            'class' => \yii\console\controllers\FixtureController::class,
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
