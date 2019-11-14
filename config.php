<?php

if (!defined("APP_ROOT") && !defined("BASE_URL")){
	define( "APP_ROOT", str_replace('\\', '/', realpath( dirname( __FILE__ ) ).'/') );
  define( "BASE_URL", sprintf("%s://%s%s",
      isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      $_SERVER['HTTP_HOST'],
      '/rilevazioni/'));
}	
 

 