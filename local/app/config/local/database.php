<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'default' => 'mysql',


	'connections' => array(

		'mysql' => array(
			'driver'    => 'mysql',
			'host'      => 'localhost',
			'database'  => 'power',
			'username'  => 'developers',
			'password'  => 'devtest',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

		 'mysql2' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'pod',
            'username'  => 'developers',
            'password'  => 'devtest',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
		 'login' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'db_intranet',
            'username'  => 'developers',
            'password'  => 'devtest',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
		 'intranet' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'another_db',
            'username'  => 'developers',
            'password'  => 'devtest',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
 
	),

);
