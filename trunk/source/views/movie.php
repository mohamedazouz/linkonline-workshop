<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="https://apis.google.com/js/plusone.js">
            {parsetags: 'explicit'}
        </script>
        <title></title>
    </head>
    <body>
        <h1><a href="index.php?con=home">Back to Menu</a></h1>
        <label>
            Movie Name
        </label>
        <?= $movie['name'] ?>
        <br/>
        <label>
            Movie Date
        </label>
        <?= date("d-m-Y", strtotime($movie['date'])) ?>
        <br/>
        <label>
            Movie Poster
        </label>
        <?php if ($movie['poster']) {
        ?>
            <img src="<?= UPLOADS_URL . "movies/" . $movie['poster'] ?>" width="50" height="50"/>
        <?php } ?>
        <br/>
        <label>
            Movie Description
        </label>
        <?= $movie['description'] ?>

        <br/>
        <label>
            Movie Language
        </label>
        <?= $movie['language'] ?>

        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <span class="f-r facebook-like">

            <g:plusone size="tall" ></g:plusone>

            <!-- Place this render call where appropriate -->
            <script type="text/javascript">gapi.plusone.go();</script>
        </span>
        <span class="f-r facebook-like"> <iframe src="//www.facebook.com/plugins/like.php?href=<?= urlencode(BASE_URL."?con=home&page=movie&id={$movie['id']}") ?>&amp;send=false&amp;layout=box_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:44px; height:62px; margin-top: -2px;" allowTransparency="true"></iframe></span>


        <iframe allowtransparency="true" frameborder="0" scrolling="no"
                src="http://platform.twitter.com/widgets/tweet_button.html?size=medium&url=<?=  urlencode(BASE_URL."?con=home&page=movie&id={$movie['id']}")?>&text=<?= $movie['name'] ?>&count=vertical"
                style="width:130px; height:65px;"class="twitter-share-button f-r"></iframe>


    </body>
</html>
