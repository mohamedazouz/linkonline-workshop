<?php

// if u work on local machine, then enable this option, this uses next static values instead of real ones, all from 'includes/localmode.php' :
// $session, $uid, $me

define("LOCAL_MODE", true);
if (LOCAL_MODE) {
    define("BASE_URL", 'http://localhost/LinkOnLine-workshop/trunk/source/');
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "xwwx11");
    define("DB_DATABASE", "mam");

} else {
   define("BASE_URL", 'http://localhost/LinkOnLine-workshop/trunk/source/');
    define("DB_HOST", "127.0.0.1");
    define("DB_USER", "root");
    define("DB_PASS", "xwwx11");
    define("DB_DATABASE", "mam");
}


// uploads
define("UPLOADS_URL", "http://localhost/LinkOnLine-workshop/trunk/source/uploads/");
define("UPLOADS_DIR", "D:\Work\LinkOnLine-workshop\\trunk\source\uploads\\");
define('DEFAULT_UPLOAD_DIR', UPLOADS_DIR);

?>
