<?php

define("ENVIRONMENT", "development");

if (ENVIRONMENT == "development") {
	define("BASE_URL", "http://localhost:8000/");
	define("DATABASE", [
		'hostname' => '127.0.0.1',
		'username' => 'root',
		'password' => 'Nova@123',
		'database' => 'test_2',
		'dbdriver' => 'mysql',
		'port'     => 3306
	]);
} else {
	define("BASE_URL", "http://localhost:8000/");
	define("DATABASE", [
		'hostname' => '127.0.0.1',
		'username' => 'root',
		'password' => 'Nova@123',
		'database' => 'test_2',
		'dbdriver' => 'mysql',
		'port'     => 3306
	]);
}