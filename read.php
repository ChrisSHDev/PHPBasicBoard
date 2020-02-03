<?php 
    /*Database open and Stand-by*/
    require("config.php");
    require("db.php");
    $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

    /*Setting up variables */
    $id = $_GET['id'];
    $no = $_GET['no'];

    //Updating views
    $ch = "update board set see = see+1 where id=".$_GET['id'];
    $result = mysqli_query($ch, $conn);

    //Get posting data
    $edit = "select id, name, email, title, comment, wdate, ip, see from board where id=".$_GET['id'];
    $result = mysqli_query($conn, $edit);
    $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style-read.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Board Sample</title>
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Chris' Board</h1>
    </div>

    <!-- List Format -->
    <style>
    .jumbotron {
        background-color: blue;
        color: #fff;
        padding: 100px 25px;
    }

    .container-fluid {
        padding: 60px 25px;
    }

    div {
        font-size: 0.9375em;
    }

    a:link {
        color: black;
        text-decoration: none;
        font-size: 0.9375em;
    }

    a:visited {
        text-decoration: none;
        color: blue;
        font-size: 0.9375em;
    }

    a:hover {
        text-decoration: underline;
        color: black;
        font-size: 0.9375em;
    }
    </style>

    <div class="container" style="word-break: break-all;">
        <h2>
            <?php 
                echo nl2br(str_replace('','&nbsp;',strip_tags($row['title'], '<a><h1><h2><h3><h4><h5><ul><ol><li><b><i><img>')));
            ?>
        </h2>

        <div class="row">
            <div class="col-sm-4">
                <div class="alert alert-success">
                    <div class="alert-heading">
                        Write
                    </div>
                    <div class="panel-body">
                        <?=$row['name']?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="alert alert-warning">
                    <div class="alert-heading">
                        E-mail
                    </div>
                    <div class="panel-body">
                        <?=$row['email']?>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="alert alert-info">
                    <div class="alert-heading">
                        Date
                    </div>

                    <div class="panel-body">
                        <?=$row['wdate']?>
                    </div>
                </div>
            </div>
            <div class="col-sm-1">
                <div class="alert alert-danger">
                    <div class="alert-heading">
                        View
                    </div>
                    <div class="panel-body">
                        <?=$row['see']?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-dark">
                    <div class="alert-heading">
                        <h4>Content</h4>
                    </div>
                    <div class="panel-body">
                        <?php echo nl2br(str_replace('','&nbsp;', strip_tags($row['comment'], '<a><h1><h2><h3><h4><h5><ul><ol><li><b><i><img>'))) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-group btn-group-justified">
            <a href=list.php?no=<?=$no?> class="btn btn-success"> Show List </a>
            <a href=write.php class="btn btn-info">Write</a>
            <a href=edit.php?id=<?=$id?> class="btn btn-danger">Update</a>
            <a href=predel.php?id=<?=$id?> class="btn btn-warning">Delete</a>
        </div>

        <div class="well" style="text-align:center; font-size: 0.9375em;">
            <?php 
                    echo "<ul class='pagination'>";

                    $read = "select id from board where id > $id limit 1";
                    $result = mysqli_query($conn, $read);
                    $prev = mysqli_fetch_array($result);

                    //if there is previous posting

                    if(empty($prev['id'] === false ))
                    {
                        echo "<li class='previous'><a href=read.php?id=$prev[id]>".$prev['id']."&nbsp;<span class='glyphicon glyphicon-circle-arrow-left'></span></a></li>&nbsp;&nbsp;";
                    }
                    else{
                        echo "<li class='previous'><span class='glyphicon glyphicon-pause'></span></li>&nbsp;&nbsp;";
                    }

                    //show current page's id
                    echo "<span style='font-size:1.25em;'>".$id."</span>";

                    $read2 = "select id from board where id < $id order by id desc limit 1";
                    $result2 = mysqli_query($conn, $read2);
                    $next = mysqli_fetch_array($result2);

                    if(empty($next['id'] === false))
                    {
                        echo "&nbsp;&nbsp;<li class='next'><a href=read.php?id=$next[id]><span class='glyphicon glyphicon-circle-arrow-right'></span>&nbsp;".$next['id']."</a></li>";
                    }
                    else {
                        echo " &nbsp;&nbsp;<li class='next'><span class='glyphicon glyphicon-pause'></span></li>";
                    }

                    echo "</ul>"
                ?>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>