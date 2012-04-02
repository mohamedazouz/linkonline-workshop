<?php

if ($page == 'home' || $page == 'default') {
    $innerPage = "views/home.php";
    $movies_list = $db->select("movie");
    foreach ($movies_list as $key => $value) {
        $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    }
    $actor_list = $db->select("actor");
    include $innerPage;
}

if ($page == 'movie') {
    $innerPage = "views/home.php";
    $id = $_GET['id'];
    if ($id) {
        $movie = $db->select_record("movie", "id={$id}");
        $movie['language'] = $db->select_record("languages", "id={$movie['language_id']}");
        $innerPage = "views/movie.php";
    }
    include $innerPage;
}
?>
