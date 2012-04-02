<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
        <title>Add Movie</title>
        <script>
            $(function(){
                $('#add_actor').validate();
                $('#add_actor').submit(function(){
                    if($('#add_actor').valid()){
                        return true;
                    }
                    return false;
                });
            })
        </script>
    </head>
    <body>
        <h1><a href="index.php?con=home">Back to Menu</a></h1>
        <h1><?= $id ? "Edit" : "Add" ?> Actor</h1>

        <form method="post" id="add_actor" enctype="multipart/form-data">
            <label>
                Actor Name
            </label>
            <input type="text" name="name" class="required" value="<?= $actor['name'] ?>"/>
            <br/>
            <label>
                Actor Image
            </label>
            <?php if ($actor['image']) {
            ?>
                <img src="<?= UPLOADS_URL . "actors/" .$actor['image'] ?>" width="50" height="50"/>
            <?php } ?>
            <input type="file" name="image" class="<?= $movie['image'] ? "" : "required" ?>"/>
            <br/>
            <input type="submit" value="<?= $id ? "save" : "insert" ?>" onclick="$('#add_actor').submit();return false;"/>
        </form>
    </body>
</html>
