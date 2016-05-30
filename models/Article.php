<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.05.16
 * Time: 9:03
 */

class Article
{

    public static function getArticles(){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Articles` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetchAll();

        return $result;
    }

    public static function saveArticle($title,$content,$author){
        $db = Db::getConnection();

        if($db){

            $query = "INSERT INTO `Articles`(`Title`,`Content`,`Author`,`Date`) VALUES (:title,:content,:author,".date('y-m-d').")";

            $result = $db->prepare($query);
            $result->bindParam(':title',$title,PDO::PARAM_STR);
            $result->bindParam(':content',$content,PDO::PARAM_STR);
            $result->bindParam(':author',$author,PDO::PARAM_STR);

            $result = $result->execute();

            return $result;
        }
    }
}