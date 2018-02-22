<?php
    include_once('db.php');

    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d');

    //adding a row to posts table
    $sql = "INSERT INTO posts (`title`, `content`, `date`) VALUES ('$title', '$content', '$date')";
    if ($connect->query($sql) == TRUE) {
        echo "success";
    }
    else {
        echo "error";
    }
?>