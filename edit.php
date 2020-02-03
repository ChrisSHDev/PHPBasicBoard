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

        $edit = "select id, name, email, title, comment, ip from board where id=".$_GET['id'];
        console_log($_GET['id']);
        $result = mysqli_query($conn, $edit);
        $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style-update.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Board Example</title>
</head>
<body>
    <div class="jumbotron text-center">
        <h2>Horizontal form: Chris' board</h2>
        <br>
        <form action="update.php?id=<?=$row['id']?>" class="form-horizontal" method="post">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="s_name" id="name" value="<?=$row['name']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="s_email" id="email" value="<?=$row['email']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="s_pass" id="pass" placeholder="Enter Password">
                    <span class="help-block" style="text-align:right;">(Mandatory for update or remove</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="s_title" id="title" value="<?=$row['title']?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Comment</label>
                <div class="col-sm-10">
                    <textarea name="s_comment" id="comment" cols="30" rows="10" class="form-control"><?=$row['comment']?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-block btn-lg">Save</button>
            <button type="reset" class="btn btn-danger btn-block btn-lg">Rewrite</button>
            <button type="button" class="btn btn-warning btn-block btn-lg" onclick="history.back(-1)">Back</button>
        </form>
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