<?php

/**
 * Choosing framework to use
 */
define('DEFAULT_FRAMEWORK', 'yii');
$fwFile = __DIR__.'/_.php';
$__framework = empty($_GET['__framework'])
    ? is_file($fwFile)
        ? in_array($fw = substr(trim(file_get_contents($fwFile)), 0, 7), ['yii', 'laravel'])
            ? $fw : DEFAULT_FRAMEWORK
        : DEFAULT_FRAMEWORK
    : in_array($fw = substr(trim($_GET['__framework']), 0, 7), ['yii', 'laravel'])
        ? $fw : DEFAULT_FRAMEWORK;
file_put_contents($fwFile, $__framework);

/**
 * Launching choosed framework
 */
switch ($__framework) {
    case 'laravel':
        define('LARALEL_PATH_INDEXFILE',  __DIR__.'/laraproject/public/index.php');
        $_SERVER['SCRIPT_FILENAME'] = LARALEL_PATH_INDEXFILE;
        require_once LARALEL_PATH_INDEXFILE;
        break;
    case 'yii':
    default:
        define('YII_PATH_INDEXFILE',  __DIR__.'/yiiproject/web/index.php');
        $_SERVER['SCRIPT_FILENAME'] = YII_PATH_INDEXFILE;
        require_once YII_PATH_INDEXFILE;
}
