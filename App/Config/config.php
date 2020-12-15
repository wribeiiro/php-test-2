<?php

define("APP_ENVIRONMENT", "development");
define("DB_ENVIRONMENT", "mysql");

$dbMysql['hostname']    = "127.0.0.1";
$dbMysql['username']    = "root";
$dbMysql['password']    = "root";
$dbMysql['database']    = "test_2";
$dbMysql['dbdriver']    = "mysql";
$dbMysql['port']        = 3306;

$dbPostgres['hostname'] = "127.0.0.1";
$dbPostgres['username'] = "postgres";
$dbPostgres['password'] = "root";
$dbPostgres['database'] = "test_2";
$dbPostgres['dbdriver'] = "pgsql";
$dbPostgres['port']     = 5432;

if (APP_ENVIRONMENT === "development") {
	define("BASE_URL", "http://localhost:8000/");
} else {
	define("BASE_URL", "https://wribeiiro.com/php-test-2/");
}

if (DB_ENVIRONMENT === "mysql") {
	define("DATABASE", $dbMysql);
} else {
	define("DATABASE", $dbPostgres);
}