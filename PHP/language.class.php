<?php

class language
{

    public $language;
    public $languageid;



    function get_languagedata($conn)
    {

        $sql = "SELECT language, languageid FROM language";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetchAll(PDO::FETCH_CLASS, 'language')) {

            return $row;
        }
    }





}


