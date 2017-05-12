<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 28.05.16
 * Time: 9:03
 */

class Article
{
    const SHOW_BY_DEFAULT = 10;

    public static function getApprovedArticles(){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Articles` WHERE Approved = 1 ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetchAll();

        return $result;
    }

    public static function saveArticle($title,$content,$author){
        $db = Db::getConnection();

        if($db){

            if(Users::checkUserAdmin($author)){
                $query = "INSERT INTO `Articles`(`Title`,`Content`,`Added_By`,`LastModify`,`Approved`) VALUES (:title,:content,:author,:time,1)";
            } else {
                $query = "INSERT INTO `Articles`(`Title`,`Content`,`Added_By`,`LastModify`) VALUES (:title,:content,:author,:time)";
            }


            $time = time();
            $result = $db->prepare($query);
            $result->bindParam(':title',$title,PDO::PARAM_STR);
            $result->bindParam(':content',$content,PDO::PARAM_STR);
            $result->bindParam(':author',$author,PDO::PARAM_STR);
            $result->bindParam(':time',$author,PDO::PARAM_INT);

            $result = $result->execute();

            return $result;
        }
    }

    public static function getArticlesByUserId($id){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Articles` WHERE Added_By = :id ORDER BY `id` DESC";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetchAll();

        return $result;
    }

    public static function getArticleById($id){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Articles` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];

        return $result;
    }

    public static function getArticles($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM Articles ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $result = $result->fetchAll();

        return $result;
    }

    public static function getArticlesCount(){
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) as c FROM `Articles` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetch()['c'];

        return $result;
    }

    public static function approveAllArticles(){
        $db = Db::getConnection();

        $query = "UPDATE `Articles` SET Approved = 1 WHERE Approved = 0";

        $query = $db->prepare($query);

        $result = $query->execute();

        return $result;
    }

    public static function approveArticleById($id){
        $db = Db::getConnection();

        $query = "UPDATE `Articles` SET Approved = 1 WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function deleteArticleById($id){
        $db = Db::getConnection();

        $query = "DELETE FROM `Articles` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function editArticle($id, $title,$content)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Articles` SET `Title`= :title, `Content`=:content, `LastModify`=:LastModify WHERE id = :id";

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':title',$title,PDO::PARAM_STR);
        $result->bindParam(':content',$content,PDO::PARAM_STR);
        $result->bindParam(':LastModify',$time,PDO::PARAM_STR);
        $result = $result->execute();

        return $result;
    }
}