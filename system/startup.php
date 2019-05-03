<?php
global $db;
global $user;

require_once('config.php');
require_once('mysql.php');

$db = db_connection::connection();
$user=new stdClass();

require_once('middleware.php');
