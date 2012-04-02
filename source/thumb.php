<?php

require 'includes/thumb_core.php';


// parameters
$src_file = $_GET['src'];
if (! $src_file) exit;

$width = ! isset($_GET['width']) ? 0 : $_GET['width'];
$height = ! isset($_GET['height']) ? 0 : $_GET['height'];
$format = ! isset($_GET['format']) ? THUMB_FORMAT : $_GET['format'];
$crop = ! isset($_GET['crop']) ? THUMB_CROP : $_GET['crop'];

$thumb_file = thumb ($src_file, $width, $height, $crop, $format);
//if (! $thumb_file) exit;

// now redirect to the image file
//header("Location: $thumb_file");

?>