<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--        <link rel="stylesheet" href="http://jqueryui.com/themes/base/jquery.ui.all.css">-->
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
<!--        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
        <script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.widget.js"></script>-->
        <title>Add Movie</title>
        <script>
            $(function(){
                //  $( "#datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });
                $('#add_movie').validate();
                $('#add_movie').submit(function(){
                    if($('#add_movie').valid()){
                        if($("input[name=youtube_id]").val()){
                            if($("input[name=youtube_id]").val().toLowerCase().indexOf("www.youtube.com/watch")>0){
                                $watch = $("#youtubeURL").val();
                                $watch = "http://"+$watch.replace("http://", "");
                                $("input[name=youtube_id]").val("href",$watch);
                            }else{
                                alert("wrong youtube video format");
                                return false;
                            }
                        }
                        return true;
                    }
                    return false;
                });
                $("#add_actor").click(function(){
                    var movie_id="<?= $movie['id'] ?>";
                    var actor_id=$("#actor_id").val();
                    data={
                        "movie_id":movie_id,
                        "actor_id":actor_id
                    };
                    $.post("?con=home&ajax=add_movie_actor",data,function(response){
                        if($("#movie_actors").children().hasClass('empty')){
                            $("#movie_actors").html(response);
                        }else{
                            $("#movie_actors").append(response);
                        }
                        $("#actor_id > option:selected").remove();
                    })
                    
                })
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
                Movie Trial
            </label>
            <?php if ($movie['youtube_id']) {
            ?>
                <iframe width="460" height="400" src="http://www.youtube.com/embed/<?= $movie['youtube_id'] ?>?wmode=transparent" frameborder=""   allowfullscreen />

        </iframe>
            <br/>
        <?php } ?>
            <input type="text" name="youtube_id"/>
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
    <?php if ($movie) { ?>

                <h3>Movie Actors</h3>
                <div id="movie_actors">
        <?php
                if ($movie_actors) {
                    foreach ($movie_actors as $value) {
                        echo $value['name'] . "<br/>";
                    }
                } else {
                    echo "<div class='empty'>No actor assigned to this movie</div>";
                }
        ?>
            </div>
            <br/>
            <br/>
            <select id="actor_id">
        <?php foreach ($actors as $value) {
        ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
        <?php } ?>
            </select>
            <a href="javascript:void(0)"id="add_actor"> add actor</a>
    <?php } ?>
</body>
</html>
