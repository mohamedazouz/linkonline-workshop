<?php

if ($page == 'login') {
    $innerPage = "views/backend_login.php";
    if ($_POST) {
        $checklogin = $auth->login($_POST['username'], $_POST['pass']);
        if ($checklogin) {
            header("Location: index.php?con=home&page=home");
        }
    }
    include $innerPage;
}
?>
