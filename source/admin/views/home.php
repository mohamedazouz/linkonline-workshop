<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
    <body>
welcome
<?= $me['name'] ?> ,<br/>

<a href="index.php?con=home&page=add_movie">New Movie</a><br/>
<a href="index.php?con=home&page=add_actor">New Actor</a>

<br/>
<br/>
<br/>
<h1>Movies</h1>
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
                    Edit
                </th>
            </tr>
        </thead>
        <tbody>

       <?php foreach ($movies_list as $value) {
?>
            <tr>
                <td><?=$value['name']?></td>
                <td><img src="<?= UPLOADS_URL . "movies/" . $value['poster'] ?>" width="50" height="50"/></td>
                <td><?=$value['description']?></td>
                <td><?=date("d-m-Y", strtotime($value['date']))?></td>
                <td><?=$value['language']['name']?></td>
                <td><a href="index.php?con=home&page=add_movie&id=<?=$value['id']?>">Edit</a></td>
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
                <th>
                    Edit
                </th>
            </tr>
        </thead>
        <tbody>

       <?php foreach ($actor_list as $value) {
?>
            <tr>
                <td><?=$value['name']?></td>
                <td><img src="<?= UPLOADS_URL . "actors/" . $value['image'] ?>" width="50" height="50"/></td>
                <td><a href="index.php?con=home&page=add_actor&id=<?=$value['id']?>">Edit</a></td>
            </tr>

<?php } ?>
    </tbody>
</table>
  </body>
</html>
