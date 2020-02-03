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

        $delete = "select pass from board where id =".$_GET['id'];
        $result6 = mysqli_query($conn, $delete);
        $row = mysqli_fetch_array($result6);

        console_log($result6);
        console_log($delete);
        console_log($row['pass']);
        console_log($_POST['s_pass']);

        if($_POST['s_pass'] == $row['pass']){
            $conndel = "delete from board where id=".$_GET['id'];
            $result9 = mysqli_query($conn, $conndel);
        }

        else{
            echo("
            <script>
                alert('password is not correct');
                history.go(01);
            </script>
            ");
            exit;
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