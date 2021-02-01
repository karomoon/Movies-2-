<?php
    include('../api/base.php');
    
    $item = new Movie($db);

    $item->title = isset($_GET['title']) ? $_GET['title'] : die();
  
    $item->getSingleMovie();

    if($item->title != null){
        // create array
        $movie_arr = array(
            "Movieid" =>  $item->Movieid,
            "title" => $item->title,
            "has_seen" => $item->has_seen,
            "genre" => $item->genre,
            "actors" => $item->actors
        );
        http_response_code(200);
        echo json_encode($movie_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Movie not found.");
    }
?>