<?php


class movies {
    public $title;
    public $description;
    public $dimension;
    public $length;
    public $language;


    function __construct($title, $description,$dimension,$length,$language) {
        $this->title = $title;
        $this->description = $description;
        $this->dimension = $dimension;
        $this->length = $length;
        $this->language = $language;

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





