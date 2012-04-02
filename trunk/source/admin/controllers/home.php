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
if ($page == 'add_movie') {
    $innerPage = "views/add_movie.php";
    $id = $_GET['id'];
    if ($_POST) {
        $_POST['date'] = date("Y-m-d H:i", strtotime($_POST['date']));
        if ($id) {
            $db->update("movie", $_POST, "id={$id}");
        } else {
            $id = $db->insert("movie", $_POST);
        }
        if ($_FILES['poster']['name']) {
            $filename = upload($_FILES['poster'], UPLOADS_DIR . "movies\\", $id . '_poster', true);
            $db->update('movie', array('poster' => $filename), "id = $id");
        }
        header("Location: index.php?con=home&page=add_movie&id={$id}");
    }
    if ($id) {
        $movie = $db->select_record("movie", "id={$id}");
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
?>
