<?php
    class Movie{

        // Connection
        private $conn;

        // Table
        private $db_table = "mymovies";

        // Columns
        public $Movieid;
        public $title;
        public $has_seen;
        public $genre;
        public $actors;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMovies(){
            $sqlQuery = "SELECT Movieid, title, has_seen, genre, actors FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createMovie(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        has_seen = :has_seen, 
                        genre = :genre, 
                        actors = :actors";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->has_seen=htmlspecialchars(strip_tags($this->has_seen));
            $this->genre=htmlspecialchars(strip_tags($this->genre));
            $this->actors=htmlspecialchars(strip_tags($this->actors));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":has_seen", $this->has_seen);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":actors", $this->actors);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleMovie(){
            $sqlQuery = "SELECT
                        Movieid, 
                        title, 
                        has_seen, 
                        genre, 
                        actors
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       title = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->title);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Movieid = $dataRow['Movieid'];
            $this->title = $dataRow['title'];
            $this->has_seen = $dataRow['has_seen'];
            $this->genre = $dataRow['genre'];
            $this->actors = $dataRow['actors'];
        }        

        // UPDATE
        public function updateMovie(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        has_seen = :has_seen, 
                        genre = :genre, 
                        actors = :actors
                    WHERE 
                        Movieid = :Movieid";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->has_seen=htmlspecialchars(strip_tags($this->has_seen));
            $this->genre=htmlspecialchars(strip_tags($this->genre));
            $this->actors=htmlspecialchars(strip_tags($this->actors));
            $this->Movieid=htmlspecialchars(strip_tags($this->Movieid));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":has_seen", $this->has_seen);
            $stmt->bindParam(":genre", $this->genre);
            $stmt->bindParam(":actors", $this->actors);
            $stmt->bindParam(":Movieid", $this->Movieid);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteMovie(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Movieid = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Movieid=htmlspecialchars(strip_tags($this->Movieid));
        
            $stmt->bindParam(1, $this->Movieid);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>