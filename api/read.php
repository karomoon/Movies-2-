<?php
    include('../api/base.php');

    $items = new Movie($db);

    $stmt = $items->getMovies();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $movieArr = array();
        $movieArr["body"] = array();
        $movieArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "Movieid" => $Movieid,
                "title" => $title,
                "has_seen" => $has_seen,
                "genre" => $genre,
                "actors" => $actors
            );

            array_push($movieArr["body"], $e);
        }
        echo json_encode($movieArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>