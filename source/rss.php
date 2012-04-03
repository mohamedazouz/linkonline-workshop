<?php

include_once 'init.php';

$movies_list = $db->query("SELECT * from movie ORDER BY  date DESC limit 10");
foreach ($movies_list as $key => $value) {
    $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    $movies_list[$key]['actors'] = $db->select("actor", " id in (SELECT actor_id from movie_actor where movie_id={$value['id']} )");
}

$now = date("D, d M Y H:i:s T");

$output = "<?xml version=\"1.0\"?>
            <rss version=\"2.0\">
                <channel>
                    <title>mAmZ Channel</title>
                    <link>http://www.mAmZ.com/RSS.php</link>
                    <description>Movies rss</description>
                    <language>en-us</language>
                    <pubDate>$now</pubDate>
                    <lastBuildDate>$now</lastBuildDate>
                    <docs>http://azouz.com</docs>
                    <managingEditor>mohamedaliazouz@gmail.com</managingEditor>
                    <webMaster>mohamedaliazouz@gmail.com</webMaster>
            ";

foreach ($movies_list as $value) {
    $output .= "<item>";
    $output .= "<title>" . $value['name'] . "</title>";
    $output .= "<link>" . BASE_URL . "index.php?con=home&page=movie&id={$value['id']}" . "</link>";
    $output .= "<description>" . $value['description'] . "</description>";
    $output .= "<pubDate>" . date("d-m-Y", strtotime($value['date'])) . "</pubDate>";
    if ($value['actors']) {
        $output .="<actors>";
        foreach ($value['actors'] as $actor) {
            $output .="<name> {$actor['name']}</name>";
        }
        $output .="</actors>";
    }
    $output .="<language>{$value['language']['name']}</language>";
    $output .="</item>";
}
$output .= "</channel></rss>";
header("Content-Type: application/rss+xml");
echo $output;
?>