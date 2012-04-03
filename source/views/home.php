<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
        <script>
            $(function(){
                $("#filter_actor").click(function(){
                    var actor_name=$("input[name=actor_name]").val();
                    data={
                        "actor_name":actor_name
                    };
                    $.post("?con=home&ajax=filter_movie_actor",data,function(response){
                        $("#movies_list").html(response);
                    })
                    
                })
            })
        </script>
    </head>
    <body>
        welcome
        <?= $me['name'] ?> ,<br/>


        <br/>
        <br/>
        <br/>
        <h1>Movies</h1>
        <h4> <a href="index.php?con=home&page=gallery">Movies Gallery</a> </h4>
        <h4> Filter Movies by Actor name</h4>
        <label>
            Actor name
        </label>
        <input type="text" name="actor_name"/>
        <br/>
        <a href="javascript:void(0)"id="filter_actor">Filter By Actor</a>
        <br/>
        <table >
            <thead>
                <tr>
                    <th>
                        Movie Name
                    </th>
                    <th>
                        Movie Poster
                    </th>
                    <th>
                        Movie Description
                    </th>
                    <th>
                        Movie Date
                    </th>
                    <th>
                        Movie Language
                    </th>
                    <th>
                        Open Movie
                    </th>
                </tr>
            </thead>
            <tbody id="movies_list">

                <?php foreach ($movies_list as $value) {
                ?>
                    <tr>
                        <td><?= $value['name'] ?></td>
                        <td><img src="<?= UPLOADS_URL . "movies/" . $value['poster'] ?>" width="50" height="50"/></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= date("d-m-Y", strtotime($value['date'])) ?></td>
                        <td><?= $value['language']['name'] ?></td>
                        <td><a href="index.php?con=home&page=movie&id=<?= $value['id'] ?>">open</a></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <h1>Actors</h1>
        <table >
            <thead>
                <tr>
                    <th>
                        Actor Name
                    </th>
                    <th>
                        Actor Image
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($actor_list as $value) {
                ?>
                    <tr>
                        <td><?= $value['name'] ?></td>
                        <td><img src="<?= UPLOADS_URL . "actors/" . $value['image'] ?>" width="50" height="50"/></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </body>
</html>
