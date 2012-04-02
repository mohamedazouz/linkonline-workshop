<?php

// includes

include_once '../init.php';


require_once '../includes/auth.php';
$auth = new Cauth();
$auth->users_table = 'user';
$auth->db = $db;
$auth->session_prefix = 'mamz_channel';
$auth->start();
$login = $auth->is_logged;













// global area, load global data used in all pages here
// ------------- global area, load global data used in all pages here -------------
$me = empty2false($auth->data);

// load generic controllers

$inAction = false;
$controllerList = array(
    "auth" => 1,
    "home" => 1
);


//  require_once ("controllers/common.php");



if ($controllerList[$controller] == 1) {
    if (!$me && $page!="login" && $con='auth') {
        header("Location: index.php?con=auth&page=login");
    } else {
        require_once ("controllers/{$controller}.php");
    }
} else {
    require_once ("404.php");
}
?>