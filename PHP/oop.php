<?php

class movies {
    public $title;
    public $description;
    public $dimension;
    public $length;
    public $language;


    function __construct($id) {
        $sql = "SELECT m.picture, m.title, m.description, m.length, l.language, l.languageid,d.dimensionid,d.dimension
        FROM movies m
        LEFT JOIN language l on l.languageid = m.languageid
        LEFT JOIN dimension d on d.dimension = m.dimensionid

        where m.moviesid = $id";

        $sql->setFetchMode(PDO::FETCH_CLASS, 'movies');

        $row = $sql->fetch();
        $this->title = $row['title'];
        $this->description =  $row['description'];
        $this->dimension =  $row['dimension'];
        $this->length =  $row['length'];
        $this->language =  $row['language'];

    }
    function get_title() {
        return $this->title;
    }
    function get_description() {
        return $this->description;
    }
    function get_dimension() {
        return $this->dimension;
    }
    function get_length() {
        return $this->length;
    }
    function get_language() {
        return $this->language;
    }
}

