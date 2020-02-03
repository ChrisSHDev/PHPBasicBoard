<?php 

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
    
        /*Database open and Stand-by*/
    require("config.php");
    require("db.php");
    $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

    $id = $_GET['id'];
    $name = $_POST['s_name'];
    $title = $_POST['s_title'];
    $email = $_POST['s_email'];
    $comment = $_POST['s_comment'];

    console_log($id);
    $upd = "select pass from board where id =".$_GET['id'];
    $result1 = mysqli_query($conn, $upd);
    console_log($result1);
    $row = mysqli_fetch_array($result1);

    console_log($upd);
    console_log($_POST['s_pass']);
    console_log($row['pass']);

    if($_POST['s_pass'] === $row['pass']){
        //$query = "update board set `name` ='$name', `title`='$title', `email`='$email', `comment`='$comment' where `id`=".$_GET['id'];
        $query = "UPDATE `board` SET `name` = '$name', `email` = '$email', `title` = '$title', `comment` = '$comment' WHERE `board`.`id` =".$_GET['id'];
        console_log($query);
        $result2 = mysqli_query($conn,$query);
        console_log($result2);

        mysqli_close($conn);
        //$row2 = mysqli_fetch_array($result2);
        //console_log($row2);
    }
    else{
        echo("
        <script>
            alert('password is not correct');
            //history.go(-1);
        </script>
        ");
       //exit;
    }

    //echo("<meta http-equiv='Refresh' content='1; URL=list.php'>");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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