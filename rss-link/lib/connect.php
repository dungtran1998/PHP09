<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
require_once 'Database.class.php';

$params		= array(
	'server' 	=> 'localhost',
	'username'	=> 'root',
	'password'	=> '',
	'database'	=> 'manage_rss',
	'table'		=> 'user',
);

$database = new Database($params);

$queryAll = 'SELECT * FROM `rss`';
$result = $database->listRecord($queryAll);
