<?php
const _NhanDuc = true;

const _MODULES = 'dashboard';
const _ACTION = 'index';
//database
const _HOST = 'localhost';
const _DB = 'manager_students';
const _USER = 'root';
const _PASSWORD ='';
const _DIVER ='mysql';
//debug error
const _DEBUG = true ;
//host 
define('_HOST_URL','http://'.$_SERVER['HTTP_HOST'].'/manager_students');
define('_HOST_URL_TEMLATES', _HOST_URL.'/templates');
//path
define('_PATH_URL',__DIR__);
define ('_PATH_URL_TEMPALTES',_PATH_URL.'/templates');

// echo _HOST_URL.'<br>' ;
// echo _HOST_URL_TEMLATES.'<br>' ;
// echo _PATH_URL.'<br>' ;
// echo _PATH_URL_TEMPALTES.'<br>' ;

