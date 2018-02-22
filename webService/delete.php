<?php
    include_once('db.php');

    $id = $_GET['id'];
    if(!empty($id)){

        //removing a row from db
        $sql = "DELETE FROM posts WHERE id = $id";
        $query = $connect->query($sql);
        if ($query) {
            $result = array("status" => 1, "info" => "Post deleted");
        }
        else{
            $result = array("status" => 1, "info" => "post was not deleted");
        }

    mysqli_close($connect);
    header('Content-type: application/json');
    echo json_encode($result);   
    }
?>