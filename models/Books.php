<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.06.16
 * Time: 20:18
 */
class Books
{
    const SHOW_BY_DEFAULT = 10; // проверить константы

    public static function getLatestBooks($count = 8){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Books` WHERE `Approved`=1 ORDER BY `id` DESC";

        $result = $db->query($query);

        $booksList = array();
        $i = 0;
        while($row = $result->fetch()){
            $booksList[$i]['id'] = $row['id'];
            $booksList[$i]['Title'] = $row['Title'];
            $booksList[$i]['Author'] = $row['Author'];
            $booksList[$i]['image_path'] = $row['img'];
            $i += 1;
        }
        return $booksList;
    }

    public static function saveBook($title,$author,$annotation,$image, $genre, $year, $link, $added_by){
        $db = Db::getConnection();

        if($db){

            if(Users::checkUserAdmin($added_by)){
                $query = "INSERT INTO `Books`(`Title`,`Author`,`Annotation`,`img`,`Genre`,`Year`,`Added_by`,`Link`,`LastModify`,`Approved`) VALUES (:title,:author,:annotation,:image,:genre,:year,:added_by,:link,:LastModify,1)";
            } else {
                $query = "INSERT INTO `Books`(`Title`,`Author`,`Annotation`,`img`,`Genre`,`Year`,`Added_by`,`Link`,`LastModify`) VALUES (:title,:author,:annotation,:image,:genre,:year,:added_by,:link,:LastModify)";
            }

            $time = time();
            $result = $db->prepare($query);
            $result->bindParam(':title',$title,PDO::PARAM_STR);
            $result->bindParam(':annotation',$annotation,PDO::PARAM_STR);
            $result->bindParam(':author',$author,PDO::PARAM_STR);
            $result->bindParam(':image',$image,PDO::PARAM_STR);
            $result->bindParam(':genre',$genre,PDO::PARAM_STR);
            $result->bindParam(':year',$year,PDO::PARAM_STR);
            $result->bindParam(':link',$link,PDO::PARAM_STR);
            $result->bindParam(':added_by',$added_by,PDO::PARAM_INT);
            $result->bindParam(':LastModify',$time,PDO::PARAM_INT);

            $result = $result->execute();

            return $result;
        }
    }

    public static function getBookByID($id){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Books` WHERE `id` = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function getBooksByUserId($id){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Books` WHERE `Approved`=1 AND Added_By=:id ORDER BY `id` DESC";

        $result = $db->prepare($query);
        $result->bindParam(":id",$id,PDO::PARAM_INT);
        $result->execute();

        $booksList = array();
        $i = 0;
        while($row = $result->fetch()){
            $booksList[$i]['id'] = $row['id'];
            $booksList[$i]['Title'] = $row['Title'];
            $booksList[$i]['Author'] = $row['Author'];
            $booksList[$i]['image_path'] = $row['img'];
            $i += 1;
        }
        return $booksList;
    }

    public static function getBooks($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM Books ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBooksCount(){
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) as c FROM `Books` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetch()['c'];

        return $result;
    }

    public static function approveAllBooks(){
        $db = Db::getConnection();

        $query = "UPDATE `Books` SET Approved = 1 WHERE Approved = 0";

        $query = $db->prepare($query);

        $result = $query->execute();

        return $result;
    }

    public static function approveBookById($id){
        $db = Db::getConnection();

        $query = "UPDATE `Books` SET Approved = 1 WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function deleteBookById($id){
        $db = Db::getConnection();

        $query = "DELETE FROM `Books` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function editBook($id,$title, $author,$annotation,$image, $genre, $year, $link)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Books` SET `Title`= :title, `Author`=:author,`Annotation`=:annotation,`img`=:image,`Genre`=:genre,`Year`=:year,`Link`=:link,`LastModify`=:LastModify WHERE id = :id";

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->bindParam(':LastModify',$time,PDO::PARAM_INT);
        $result->bindParam(':title',$title,PDO::PARAM_STR);
        $result->bindParam(':annotation',$annotation,PDO::PARAM_STR);
        $result->bindParam(':author',$author,PDO::PARAM_STR);
        $result->bindParam(':image',$image,PDO::PARAM_STR);
        $result->bindParam(':genre',$genre,PDO::PARAM_STR);
        $result->bindParam(':year',$year,PDO::PARAM_STR);
        $result->bindParam(':link',$link,PDO::PARAM_STR);

        $result = $result->execute();

        return $result;
    }
}