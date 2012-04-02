<?php

// includes

include_once 'init.php';






// global area, load global data used in all pages here
// ------------- global area, load global data used in all pages here -------------


// load generic controllers

$inAction = false;
$controllerList = array(
    "auth" => 1,
    "home" => 1
);


//  require_once ("controllers/common.php");



if ($controllerList[$controller] == 1) {
    require_once ("controllers/{$controller}.php");
} else {
    require_once ("404.php");
}
?>