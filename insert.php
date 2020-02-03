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

    $comment = mysqli_real_escape_string($conn, $_POST['s_comment']);
    $name = mysqli_real_escape_string($conn, $_POST['s_name']);
    $title = mysqli_real_escape_string($conn, $_POST['s_title']);
    //$query = "insert into board (id,name,email,pass,title,comment,wdate,ip,see) values ('','".$name."','".$_POST['s_email']."','".$_POST['s_pass']."','".$title."','".$comment."',NOW(),'".$_SERVER["REMOTE_ADDR"]."',0)";
    $query = "INSERT INTO `board` (`id`, `name`, `email`, `pass`, `title`, `comment`, `wdate`, `ip`, `see`) VALUES (NULL, '".$name."', '".$_POST['s_email']."', '".$_POST['s_pass']."', '".$title."', '".$comment."', NOW(), '".$_SERVER["REMOTE_ADDR"]."', '0')";
    
    $result = mysqli_query($conn, $query);

    console_log($query);
    mysqli_close($conn);

    echo("<meta http-equiv='Refresh' content='1; URL=list.php'>");

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
    
</body>
</html>