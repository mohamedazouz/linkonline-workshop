<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
        <script>
            $("#search_movies").submit(function(){
                if($("select[name=language_id]").val() || $("input[name=actor_name]").val()){
                    return true;
                }
                return false;
            })
        </script>
    </head>
    <body>
        <h1><a href="index.php?con=home">Back to Menu</a></h1>
        welcome
        <?= $me['name'] ?> ,<br/>

        <a href="index.php?con=home&page=add_movie">New Movie</a><br/>
        <a href="index.php?con=home&page=add_actor">New Actor</a>

        <br/>
        <br/>
        <br/>
        <h1>Movies</h1>
        <h4>Search Movies</h4>
        <form action="index.php?con=home&page=search_movies"  method="post" id="search_movies">
            <select name="language_id">
                <option value="">search Language</option>
                <?php foreach ($languages_list as $value) {
                ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                <?php } ?>
            </select>
            <br/>
            <label>
                Actor name
            </label>
            <input type="text" name="actor_name"/>
            <br/>
            <label>
                Movie Name
            </label>
            <input type="text" name="movie_name"/>
            <br/>
            <input type="submit" value="search" />
        </form>
        <table>
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
                        Edit
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($movies_list as $value) {
                ?>
                    <tr>
                        <td><?= $value['name'] ?></td>
                        <td><img src="<?= UPLOADS_URL . "movies/" . $value['poster'] ?>" width="50" height="50"/></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= date("d-m-Y", strtotime($value['date'])) ?></td>
                        <td><?= $value['language']['name'] ?></td>
                        <td><a href="index.php?con=home&page=add_movie&id=<?= $value['id'] ?>">Edit</a></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </body>
</html>