<?php

include_once ROOT.'/components/Db.php';
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.05.16
 * Time: 9:03
 */

class Article
{
    public static $COUNT_BY_DEFULT = 10;

    public static function getArticles(){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Articles`";

//        $db->prepare($query);
        $query = $db->query($query);

        $result = $query->fetchAll();

        print_r($result);

        die;

        return $result;
    }
}