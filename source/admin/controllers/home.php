<?php

if ($page == 'home' || $page == 'default') {
    $innerPage = "views/home.php";
    $movies_list = $db->select("movie");
    foreach ($movies_list as $key => $value) {
        $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    }
    $languages_list = $db->select("languages");
    $actor_list = $db->select("actor");
    include $innerPage;
}
if ($page == 'add_movie') {
    $innerPage = "views/add_movie.php";
    $id = $_GET['id'];
    if ($_POST) {
        $_POST['date'] = date("Y-m-d H:i", strtotime($_POST['date']));
        if ($_POST["youtube_id"]) {
            $youtubeURL = $_POST["youtube_id"];
            $youtubeURL = substr($youtubeURL, strpos($youtubeURL, "?v=") + 3, strlen($youtubeURL));
            if (strpos($youtubeURL, "&") > 0) {
                $youtubeURL = explode("&", $youtubeURL);
                $youtubeURL = $youtubeURL[0];
            }
            $_POST["youtube_id"] = $youtubeURL;
        }
        if ($id) {
            $db->update("movie", $_POST, "id={$id}");
        } else {
            $id = $db->insert("movie", $_POST);
        }
        if ($_FILES['poster']['name']) {
            $filename = upload($_FILES['poster'], UPLOADS_DIR . "movies/", $id . '_poster', true);
            $db->update('movie', array('poster' => $filename), "id = $id");
        }
        header("Location: index.php?con=home&page=add_movie&id={$id}");
    }
    if ($id) {
        $movie = $db->select_record("movie", "id={$id}");
        $sql = "select * from actor where id in (select actor_id from movie_actor  where movie_id ={$id}) ";
        $movie_actors = $db->query($sql);
        $sql = "select * from actor where id not in (select actor_id from movie_actor where movie_id ={$id}) ";
        $actors = $db->query($sql);
    }
    $languages_list = $db->select("languages");
    include $innerPage;
}
if ($page == 'add_actor') {
    $innerPage = "views/add_actor.php";
    $id = $_GET['id'];
    if ($_POST) {
        if ($id) {
            $db->update("actor", $_POST, "id={$id}");
        } else {
            $id = $db->insert("actor", $_POST);
        }
        if ($_FILES['image']['name']) {
            $filename = upload($_FILES['image'], UPLOADS_DIR . "actors/", $id . '_actor', true);
            $db->update('actor', array('image' => $filename), "id = $id");
        }
        header("Location: index.php?con=home&page=add_actor&id={$id}");
    }
    if ($id) {
        $actor = $db->select_record("actor", "id={$id}");
    }
    include $innerPage;
}
if ($ajax == 'add_movie_actor') {
    $id = $db->insert("movie_actor", $_POST);
    $actor = $db->select_record("actor", "id={$_POST['actor_id']}");
    echo $actor['name'] . " <br/>";
}

if ($page == 'search_movies') {
    $innerPage = "views/movie_search.php";
    $sql = "select * from movie where 1 ";
    $actor_name = $_POST['actor_name'];
    if ($actor_name) {
        $sql.=" AND id in (select movie_id from movie_actor where actor_id in (select id from actor where name like '%$actor_name%')) AND 1 ";
    }
    $movie_name = $_POST['movie_name'];
    if ($movie_name) {
        $sql.=" AND name like '%$movie_name%' AND 1";
    }
    $language_id = $_POST['language_id'];
    if ($language_id) {
        $sql.=" AND language_id in (select id from languages where id=$language_id)";
    }

    $movies_list = $db->query($sql);
    echo $sql;
    foreach ($movies_list as $key => $value) {
        $movies_list[$key]['language'] = $db->select_record("languages", "id={$value['language_id']}");
    }
    $languages_list = $db->select("languages");
    include $innerPage;
}
?>
