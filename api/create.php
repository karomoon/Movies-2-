<?php
    include('../api/base.php');

    $item = new Movie($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->title = $data->title;
    $item->has_seen = $data->has_seen;
    $item->genre = $data->genre;
    $item->actors = $data->actors;
    
    if($item->createMovie()){
        echo 'Movie created successfully.';
    } else{
        echo 'Movie could not be created.';
    }
?>