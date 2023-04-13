<?php


define('SCHEME', $_SERVER['REQUEST_SCHEME'] . '://');
define('HOST', $_SERVER['HTTP_HOST']);
define('URL', rtrim(dirname($_SERVER['PHP_SELF']), '/\\'));
