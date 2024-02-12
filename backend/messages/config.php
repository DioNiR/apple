<?php

return [
    'sourcePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
    'languages' => ['ru', 'en'],
    'translator' => 'Yii::t',
    'sort' => true,
    'removeUnused' => true,
    'markUnused' => true,
    'only' => ['*.php'],
    'except' => [
        '.svn',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '/messages',
        '/vendor',
    ],

    'format' => 'php',
    'messagePath' => __DIR__,
    'overwrite' => true,
    'ignoreCategories' => [
        'yii',
    ],
];
