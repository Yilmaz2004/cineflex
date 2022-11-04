<?php
include '../private/conn.php';
class genre
{

    public $genre;


}
    function __construct() {

        $sql = $conn->query("SELECT * FROM genre");
        $sql->setFetchMode(PDO::FETCH_CLASS, 'genre');
        $row = $sql->fetch();
        $this->genre =  $row['genre'];

    }

    function get_genre() {
        return $this->genre;
    }



