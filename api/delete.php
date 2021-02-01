<?php
    include('../api/base.php');
    
    $item = new Movie($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->Movieid = $data->Movieid;
    
    if($item->deleteMovie()){
        echo json_encode("Movie deleted.");
    } else{
        echo json_encode("Data could not be deleted");
    }
?>