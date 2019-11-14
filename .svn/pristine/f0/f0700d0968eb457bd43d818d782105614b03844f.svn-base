<?php


use backend\app\aop\ApplicationAspectKernel;
include("config.php");
//AOP
$applicationAspectKernel = ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
        'debug' => true, // Use 'false' for production mode
        // Cache directory
        'cacheDir' => __DIR__ . './../cache/', // Adjust this path if needed
        // Include paths restricts the directories where aspects should be applied, or empty for all source files
        'includePaths' => array(
           APP_ROOT . '/backend'
        )
));
