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
        $sql = "select * from actor where id  in (select actor_id from movie_actor where movie_id ={$id}) ";
        $movie_actors = $db->query($sql);

        $innerPage = "views/movie.php";
    }
    include $innerPage;
}
if ($ajax == 'filter_movie_actor') {
    $innerPage = "views/movie_filter.php";
    $sql = "select * from movie where 1 ";
    $actor_name = $_POST['actor_name'];
    if ($actor_name) {
        $sql.=" AND id in (select movie_id from movie_actor where actor_id in (select id from actor where name like '%$actor_name%')) AND 1 ";
    }
    $movies_list = $db->query($sql);
    foreach ($movies_list as $key => $value) {
        $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    }
    include $innerPage;
}
if ($page == 'gallery') {
    $innerPage = "views/movie_gallery.php";
    $movies_list = $db->select("movie");
    foreach ($movies_list as $key => $value) {
        $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    }
    include $innerPage;
}
?>
