<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="views/js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="views/js/jquery.validate.js"></script>
        <style>

            div#feature_list {
                width: 655px;
                height: 318px;
                overflow: hidden;
                position: relative;
            }
            div#feature_list ul {
                position: absolute;
                top: 0;
                list-style: none;
                padding: 0;
                margin: 0;
            }
            ul#tabs {
                right: 0;
                z-index: 2;
                width: 279px;
            }
            ul#tabs li {
                font-size: 12px;
                font-family: Arial;
            }
            ul#tabs li a {
                color: #222;
                text-decoration: none;
                display: block;
                height: 36px;
                background:#f1f1f2;
                border-bottom:1px solid #b5b5b5;
                width:261px;
                float:right;
                outline:0;
            }
            ul#tabs li a.current {
                background:url(views/images/news-list-current.png) no-repeat 1px 0;
                color: #FFF;
                width:280px;
                border:0;
            }
            ul#output {
                left: 0;
                width: 393px;
                height: 318px;
                position: relative;
            }
            ul#output li {
                position: absolute;
                width: 394px;
                height: 318px;
            }
            #tabs h3 {
                margin:0;
                font-size:11px;
                margin-left:12px;
                line-height:35px;
            }
            ul#tabs li a.current h3 {
                margin-left:28px;
            }
            .news-image {
                width:393px;
                height:262px;
                border: 1px solid #CCC;
            }

            .news-image img {
                width:393px;
                height:262px;
            }
            .news-title {
                background:url(views/images/news-title.jpg) repeat-x;
                height:41px;
                padding:8px;
                color:#FFF;
                padding-top: 9px;
            }
            .news-title .share{
                margin: 0 5px;
                float: right;
                margin-top: 22px;
                margin-right: 0;;
            }
            .news-title a {
                color:#FFF;
            }
            .news-title span {
                border-right:1px solid #fcb31a;
                width: 184px;


            }
            .news-title .details {
                border:0;
                margin-left:10px;
                width: 135px;
                float: left;
            }
            .news-title h2, .news-title h3 {
                margin:0;
                font-size: 16px;
                height:41px;
            }
        </style>
        <script>
            var interval=2000;
        </script>
        <script type="text/javascript" src="views/js/jquery.featurelist.js"></script>
        <script>
            $(function(){
                
                $.featureList(
                $("#tabs li a"),
                $("#output li"), {
                    start_item	:	0
                }) 
            })
        </script>
    </head>
    <body>
        <h1><a href="index.php?con=home">Back to Menu</a></h1>
        <div id="feature_list" class="f">
            <ul id="tabs">
                <?php foreach ($movies_list as $rec) {
                ?>
                    <li>
                        <a href="index.php?con=home&page=movie&id=<?= $rec['id'] ?>">

                            <h3>  <?= brief($rec['name'], 35) ?> </h3>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul id="output">
                <?php foreach ($movies_list as $rec) {
                ?>
                    <li>
                        <div class="news-image"><img src="<?= UPLOADS_URL . "movies/" . $rec['poster'] ?>" width="130" height="100" />
                        </div>
                        <div class="news-title">
                            <span class="f">

                                <div> <a href="index.php?con=home&page=movie&id=<?= $rec['id'] ?>">
    
                                    <?= brief(($rec['name']), 25) ?>
                                </a>    </div>


                        </span>
                        <span class="details"><?= date("d M Y", strtotime($rec['date'])); ?><br />
                            <?= $rec['language']['name'] ?>
                            <?= brief($rec['description']) ?>
                                </span>
                            </div>
                        </li>
                <?php } ?>
            </ul>

        </div>

    </body>
</html>



