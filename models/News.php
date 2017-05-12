<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 05.05.17
 * Time: 0:40
 */
class News
{
    const SHOW_BY_DEFAULT = 10;

    public static function getLatestNews()
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM `News` WHERE Approved = 1 ORDER BY id DESC';

        $query = $db->query($query);

        $result = $query->fetchAll();

        return $result;
    }

    public static function getGlobalNews()
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM `News` WHERE Approved = 1 AND Location="World" ORDER BY id DESC';

        $query = $db->query($query);

        $result = $query->fetchAll();

        return $result;
    }

    public static function getLocalNews()
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM `News` WHERE Approved = 1 AND Location="Russia" ORDER BY id DESC';

        $query = $db->query($query);

        $result = $query->fetchAll();

        return $result;
    }

    public static function addNews($header,$text,$location,$image,$added_by)
    {
        $db = Db::getConnection();

        if(Users::checkUserAdmin($added_by)){
            $query = 'INSERT INTO `News`(`Header`, `Text`, `Location`, `Image`, `Added_By`, `LastModify`, `Approved`) VALUES (:header,:text,:location,:image,:added_by,:LastModify,1)';

        }else{
            $query = 'INSERT INTO `News`(`Header`, `Text`, `Location`, `Image`, `Added_By`, `LastModify`) VALUES (:header,:text,:location,:image,:added_by,:LastModify)';

        }
        $time = time();
        $query = $db->prepare($query);
        $query->bindParam(':header',$header,PDO::PARAM_STR);
        $query->bindParam(':text',$text,PDO::PARAM_STR);
        $query->bindParam(':location',$location,PDO::PARAM_STR);
        $query->bindParam(':image',$image,PDO::PARAM_STR);
        $query->bindParam(':added_by',$added_by,PDO::PARAM_STR);
        $query->bindParam(':LastModify',$time,PDO::PARAM_INT);

        return $query->execute();
    }

    public static function getNews($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM News ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getNewsById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM News WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public static function getNewsCount()
    {
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) as c FROM `News` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetch()['c'];

        return $result;
    }

    public static function approveAllNews()
    {
        $db = Db::getConnection();

        $query = "UPDATE `News` SET Approved = 1 WHERE Approved = 0";

        $query = $db->prepare($query);

        $result = $query->execute();

        return $result;
    }

    public static function approveNewsById($id)
    {
        $db = Db::getConnection();

        $query = "UPDATE `News` SET Approved = 1 WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function deleteNewsById($id)
    {
        $db = Db::getConnection();

        $query = "DELETE FROM `News` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function editNews($id, $header,$text,$location,$image)
    {
        $db = Db::getConnection();

        $query = "UPDATE `News` SET `Header`=:header, `Text`=:text, `Location`=:location, `Image`=:image, `LastModify`=:LastModify WHERE id = :id";

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':header',$header,PDO::PARAM_STR);
        $result->bindParam(':text',$text,PDO::PARAM_STR);
        $result->bindParam(':location',$location,PDO::PARAM_STR);
        $result->bindParam(':image',$image,PDO::PARAM_STR);
        $result->bindParam(':LastModify',$time,PDO::PARAM_INT);

        $result = $result->execute();

        return $result;
    }

}