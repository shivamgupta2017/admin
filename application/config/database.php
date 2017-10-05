<?php defined("BASEPATH") OR exit("No direct script access allowed");
$active_group = "default";
$query_builder = TRUE;
$db["default"] = array("dsn"=>"mysql:host=localhost;port=3306;dbname=minbazaa_b2b_db",
"hostname" => "mysql:host=localhost", 
"username" => "root" ,
"password" => "shivam",
"database" => "minbazaa_b2b_db",
"dbdriver" => "pdo",
"pconnect" => FALSE,
"db_debug" => (ENVIRONMENT !== "production"),
"cache_on" => FALSE,
"cachedir" => "",
"char_set" => "utf8",
"dbcollat" => "utf8_general_ci",
"swap_pre" => "",
"encrypt" => FALSE,
"compress" => FALSE,
"stricton" => FALSE,
"failover" => array(),
"save_queries" => TRUE);
$db['default']['dbprefix'] = "b2b_";  
$db['default']['swap_pre'] = "{PRE}";


$db['another_db'] = array(
    "dsn"=>"mysql:host=localhost;port=3306;dbname=minbazaa_subs",
    'hostname' => 'mysql:host=localhost',
    'username' => 'root',
    'password' => 'shivam',
    'database' => 'minbazaa_subs',
    'dbdriver' => 'pdo',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
