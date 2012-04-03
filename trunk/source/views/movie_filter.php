<?php foreach ($movies_list as $value) { ?>
    <tr>
        <td><?= $value['name'] ?></td>
        <td><img src="<?= UPLOADS_URL . "movies/" . $value['poster'] ?>" width="50" height="50"/></td>
        <td><?= $value['description'] ?></td>
        <td><?= date("d-m-Y", strtotime($value['date'])) ?></td>
        <td><?= $value['language']['name'] ?></td>
        <td><a href="index.php?con=home&page=movie&id=<?= $value['id'] ?>">open</a></td>
    </tr>

<?php } ?>