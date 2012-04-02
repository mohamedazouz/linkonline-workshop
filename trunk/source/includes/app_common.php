<?php

function decodeParam($params) {
    $data = base64_decode($params . "==");
    return explode("|", $data);
}

function encodeParam($params) {
    $str = "";

    foreach ($params as $param) {
        $str.= $param . "|";
    }
    return str_replace("=", "", base64_encode($str));
}

?>