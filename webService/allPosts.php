<?php
    include_once('db.php');
    
    //getting all posts from db
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $query = $connect->query($sql);
    if ($query->num_rows > 0) {

        //for each row
        while ($row = $query->fetch_array()) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $date = $row['date'];

            //create an array with the info representing row
            $result[]= array('id' => $id, 'title' => $title, 'content' => $content, 'date' => $date);
        }

        //info was fetched successfully
        $json = array('status' => 1, 'info' => $result);
    }
    else $json = array('status' => 0, 'info' => 'Couldnt find matches');

    mysqli_close($connect);
    header('Content-type: application/json');
    echo json_encode($json); //returning result as a json object
?>