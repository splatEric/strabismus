<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'RCOphth Strabismus dataset - online data collection system',
	
	// Locale
	'sourceLanguage'=>'en_gb',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.eyedraw.*',
	),

	'modules'=>array(
		'eyedraw',
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'secret',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'clientScript' => array(
			'packages' => array(
				'eyedraw' => array(
					'js' => array(
						"js/dist/eyedraw.js",
						"js/dist/oe-eyedraw.js"
					),
					'css' => array(
						'css/oe-eyedraw.css'
					),
					'basePath' => 'application.modules.eyedraw.assets',
					'depends' => array(
						'jquery',
						'mustache',
						'eventemitter2'
					),
				),
				'mustache' => array(
					'js' => array(
						"mustache.js",
					),
					'basePath' => 'application.modules.eyedraw.assets.components.mustache',
				),
				'eventemitter2' => array(
					'js' => array(
						"lib/eventemitter2.js",
					),
					'basePath' => 'application.modules.eyedraw.assets.components.eventemitter2',
				),
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
				'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		// GRANT INSERT, SELECT, UPDATE, DELETE ON strabismus_dataset.* TO 'bill'@'localhost' IDENTIFIED BY  'aylward';
			'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=strabismus',
			'emulatePrepare' => true,
			'username' => 'strabismus',
			'password' => 'strabismus',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
/*
								array(
					'class'=>'CWebLogRoute', 
				),
				
*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
