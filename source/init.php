<?php

// start session, 
session_start();


// includes
require_once 'config.php';

// database
require_once 'includes/db.php';

// common functions in all php apps and in this application
require_once 'includes/common.php';
require_once 'includes/app_common.php';
require_once 'includes/upload.php';
require_once 'includes/thumb_core.php';



// messages
$error_msg = '';
$notify_msg = '';


// anti hackers, clean post and gets
clean_html($_POST);
clean_html($_GET);
clean_html($_REQUEST);




// what is requested from me
$module = empty2false($_GET['module']);
if (!$module)
    $module = empty2false($_GET['mod']);
$mod = $module;

$controller = empty2false($_GET['controller']);
if (!$controller)
    $controller = empty2false($_GET['con']);
$con = $controller;

$page = empty2false($_GET['page']);
if (!$page)
    $page = empty2false($_GET['p']);
$ajax = empty2false($_GET['ajax']);
$action = empty2false($_GET['action']);

if (($con == false) and ($mod == false)) {
    $con = 'home';
    $controller = $con;
}
if (($page == false) and ($ajax == false) and ($action == false))
    $page = 'default';

$controllerCheck = $controller;
$actionCheck = ifempty($page, $ajax);
$actionCheck = ifempty($actionCheck, $action);
// database
$db = new Cdb();
$con = $db->connect();
$db->execute("SET NAMES 'utf8'");
$db->execute("SET time_zone = '+02:00'");
?>