<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="http://jqueryui.com/themes/base/jquery.ui.all.css">
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.widget.js"></script>
        <title>Add Movie</title>
        <script>
            $(function(){
                $( "#datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });
                $('#add_movie').validate();
                $('#add_movie').submit(function(){
                    if($('#add_movie').valid()){
                        return true;
                    }
                    return false;
                });
            })
        </script>
    </head>
    <body>
        <h1><a href="index.php?con=home">Back to Menu</a></h1>
        <h1><?= $id ? "Edit" : "Add" ?> Movie</h1>

        <form method="post" id="add_movie" enctype="multipart/form-data">
            <label>
                Movie Name
            </label>
            <input type="text" name="name" class="required" value="<?= $movie['name'] ?>"/>
            <br/>
            <label>
                Movie Date
            </label>
            <input type="text" id="datepicker" name="date" class="required" value="<?= $movie['date'] ? date("d-m-Y", strtotime($movie['date'])) : "" ?>"/>
            <br/>
            <label>
                Movie Poster
            </label>
            <?php if ($movie['poster']) {
            ?>
                <img src="<?= UPLOADS_URL . "movies/" . $movie['poster'] ?>" width="50" height="50"/>
            <?php } ?>
            <input type="file" name="poster" class="<?= $movie['poster'] ? "" : "required" ?>"/>
            <br/>
            <label>
                Movie Description
            </label>
            <textarea name="description" class="required" >
                <?= $movie['description'] ?>
            </textarea>
            <br/>
            <label>
                Movie Language
            </label>
            <select name="language_id" class="required">
                <option value="">Select Language</option>
                <?php foreach ($languages_list as $value) {
                ?>
                    <option value="<?= $value['id'] ?>" <?= $movie['language_id'] == $value['id'] ? "selected" : "" ?>><?= $value['name'] ?></option>
                <?php } ?>
            </select>

            <br/>
            <input type="submit" value="<?= $id ? "save" : "insert" ?>" onclick="$('#add_movie').submit();return false;"/>
        </form>
        <?php if ($movie) {
 ?>
        <div id="actor_list">
            
        </div>
<?php } ?>
    </body>
</html>
