<?php
    include('../api/base.php');
    $item = new Movie($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->Movieid = $data->Movieid;

    // movie values
    foreach ($data as $data) {
    $item->title = $data->title;
    $item->has_seen = $data->has_seen;
    $item->genre = $data->genre;
    $item->actors = $data->actors;
    }
    
    if($item->updateMovie()){
        echo json_encode("Movie data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>