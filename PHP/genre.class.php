<?php

class genre
{

    public $genre;
    public $genreid;

    function __construct()
    {
    }

    function get_genre($conn)
    {

        $sql = $conn->query("SELECT genre FROM genre");
        $sql->setFetchMode(PDO::FETCH_CLASS, 'genre');
        $row = $sql->fetchAll();
//        echo "<pre>", print_r($row), "</pre>";
        foreach ($row as $value) {


            $this->genre = $value->genre;


            return $this->genre;
        }

    }
    function get_genreid($conn)
    {

        $sql = $conn->query("SELECT genreid FROM genre");
        $sql->setFetchMode(PDO::FETCH_CLASS, 'genre');
        $row = $sql->fetch();
//        echo "<pre>", print_r($row), "</pre>";
        $this->genreid = $row->genreid;


        return $this->genreid;
    }
}


