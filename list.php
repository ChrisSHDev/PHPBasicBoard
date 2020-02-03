<?php 


function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$testVal = "테스트 데이터";
Console_log($testVal);


    /*Database open and Stand-by*/
    require("config.php");
    require("db.php");
    $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

    /* The number of articles on one page*/
    $page_size = 2;

    /* List size */
    $page_list_size = 10;

    /* handling to value of $no */

    $no = $_GET['no'];

    if(!$no || $no < 0){
        $no = 0;
    }
    




    $list ="select id, name, email, title, DATE_FORMAT(wdate,'%Y-%m-%d') as date, see from board order by id desc limit $no, $page_size";
    
    $result = mysqli_query($conn, $list);
    var_dump($result);
    
    // Calculating total posting numbers
    $edit = "select count(*) from board";
    $result2 = mysqli_query($conn, $edit);
    //var_dump($result2);
    $row = mysqli_fetch_row($result2);
    $total_row = $row[0];
    var_dump($total_row);

    if($total_row <= 0) $total_row = 0;

    $total_page = floor(($total_row - 1)/$page_size);

    $current_page = floor($no/$page_size);

    $PHP_SELF = $_SERVER["PHP_SELF"];

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Board Example</title>

</head>

<body>

    <div class="jumbotron text-center">
        <h1>Chris's Board</h1>
        <p>This page is for Lis of Contents!</p>
    </div>

    <div class="conainer-fluid">
        <h2>Content List : Chris' Board</h2>
        <br>
        <table class="tabe table-hover">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Views</th>
                </tr>
            </thead>

            <?php 
                echo "<tbody>";
                //$list_length = (int)$row[0];
                //echo $list_length;

                while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){

                    echo "<tr>";
                    echo "<td><a href=read.php?id=".$row['id'].">".$row['id']."</a></td>";
                    echo "<td><a href=read.php?id=".$row['id']."&no=".$no.">".strip_tags($row['title'],'<b><i><a><h1><h2><h3><h4><h5><ul><ol><li>')."</a></td>";
                    echo "<td><a href='mailto:".$row['email']."'>".$row['name']."</a></td>";
                    echo "<td>".$row['date']."</td>";
                    echo "<td>".$row['see']."</td>";
                    echo "</tr>";
                }


                mysqli_close($conn);
                echo "</tbody>";
            ?>
        </table>

    </div>

    <div class="well" style="text-align:center; font-size: 1.25em;">
                <?php 
                    $start_page = (int)($current_page / $page_list_size) * $page_list_size;

                    $end_page = $start_page + $page_list_size -1;

                    if($total_page < $end_page){
                        $end_page = $total_page;
                    }

                    if($start_page >= $page_list_size){
                        $prev_list = ($start_page -1) * $page_size;
                        echo "<a href=$PHP_SELF?no=$prev_list><span class='glyphicon glyphicon-circle-arrow-left'></span></a>&nbsp;&npsp";
                    }

                    for($i = $start_page; $i <= $end_page; $i++){
                        $page = $page_size * $i;
                        $page_num = $i + 1;
                        if($no != $page){
                            echo "&nbsp;&nbsp;<a href=$PHP_SELF?no=$page>";
                        }
                        echo $page_num;

                        if($no != $page){
                            echo "</a>&nbsp;&nbsp";
                        }
                    }

                    if($total_page > $end_page){
                        $next_list = ($end_page + 1) * $page_size;
                        echo "&nbsp;&nbsp<a href=$PHP_SELF?no=$next_list><span class='glyphicon glyphicon-circle-arrow-right'></span></a>";
                    }
                
                ?>
                <br>
                <br>
                <button type="button" class="btn btn-default">
                    <a href=write.php>Write</a></button>
                </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>