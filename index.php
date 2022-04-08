<?php

define( 'DS', DIRECTORY_SEPARATOR );
define( 'PATH_ROOT', __DIR__. DS );

define( 'DB_HOST', 'database' );
define( 'DB_USER', 'lamp' );
define( 'DB_PASS', 'lamp' );
define( 'DB_NAME', 'lamp' );



session_start();

$mysqli = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME );

require_once PATH_ROOT. './router/router.php';

routerStart();