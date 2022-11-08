<?php

class genre
{

    public $genre;
    public $genreid;



    function get_genredata($conn)
    {

        $sql = "SELECT genre, genreid FROM genre";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    while ($row = $stmt->fetchAll(PDO::FETCH_CLASS, 'genre')) {

     return $row;
        }
    }





}


