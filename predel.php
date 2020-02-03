<?php 

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
    ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    require("config.php");
    require("db.php");
    $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

    console_log($_GET['id']);

    $id = $_GET['id']; // 그냥 $_GET['id']를 넣었더니 에러가 나서 변수에 넣은 후 넣었더니 됨. line 41
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style-delete.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Board example</title>
</head>
<body>
    <div class="jumbotron text-center">
        <h1>Chris' Board</h1>
        <p>This page is for Editing</p>
    </div>

    <div class="container-fluid">
        <h2>Password Confirm: Chris' Board</h2>
        <br>
        <form action="del.php?id=<?=$id?>" method="post" class="form-horizontal" >
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="s_pass" id="pass" placeholder="Enter Password">
                    <span class="help-block" style="text-align:right;">Mandatory field to date or remove</span>
                </div>
            </div>

            <div style="text-align:center;">
                <button type="submit" class="btn btn-success btn-lg">Save</button>
                <button type="button" class="btn btn-warning btn-lg" onclick="history.back(-1)">Back</button>
            </div>
        
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>