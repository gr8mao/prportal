<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.05.17
 * Time: 16:06
 */
class Сommentary
{
    public static function getSectionCommentary($section, $id)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Сommentary` as c WHERE c.Section=:sec AND c.Item_id=:id ORDER BY `id` DESC";

        $result = $db->prepare($query);
        $result->bindParam(':sec',$section,PDO::PARAM_STR);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();

        $commentList = array();
        $i = 0;
        while($row = $result->fetch()){
            $commentList[$i]['id'] = $row['id'];
            $commentList[$i]['Profile_Photo_Path'] = Users::getProfilePhotoById($row['Added_By']);
            $commentList[$i]['Added_By'] = Users::getUsernameById($row['Added_By']);
            $commentList[$i]['Title'] = $row['Title'];
            $commentList[$i]['Text'] = $row['Text'];
            $commentList[$i]['Date'] = $row['Date'];
            $i++;
        }
        return $commentList;
    }

    public static function getCommentCount($section, $id)
    {
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) FROM `Сommentary` as c WHERE c.Section=:sec AND c.Item_id=:id ORDER BY `id` DESC";

        $result = $db->prepare($query);
        $result->bindParam(':sec',$section,PDO::PARAM_STR);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function saveComment($added_by, $title, $text, $section, $item_id){
        $db = Db::getConnection();

        $query = "INSERT INTO `Сommentary`(`Added_By`, `Title`, `Text`, `Section`, `Item_id`, `LastModify`) VALUES (:user,:title,:text,:section,:item,:LastModify)";

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':user',$added_by,PDO::PARAM_STR);
        $result->bindParam(':title',$title,PDO::PARAM_STR);
        $result->bindParam(':text',$text,PDO::PARAM_STR);
        $result->bindParam(':section',$section,PDO::PARAM_STR);
        $result->bindParam(':item',$item_id,PDO::PARAM_INT);
        $result->bindParam(':LastModify',$time,PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteComment($id)
    {
        $db = Db::getConnection();

        $query = "DELETE FROM Сommentary WHERE id = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id',$id,PDO::PARAM_INT);

        return $result->execute();
    }
}