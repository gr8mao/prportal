<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.06.16
 * Time: 20:18
 */
class Books
{
    const COUNT_BY_DEFAULT = 8;

    public static function getLatestBooks($count = 8){
        $db = Db::getConnection();

        $query = "SELECT * FROM `Books` ORDER BY `id` DESC";

        $result = $db->query($query);
        //$result->bindParam(':count_',$count,PDO::PARAM_INT);

        $booksList = array();
        $i = 0;
        while($row = $result->fetch()){
            $booksList[$i]['id'] = $row['id'];
            $booksList[$i]['Title'] = $row['Title'];
            $booksList[$i]['Author'] = $row['Author'];
            $i += 1;
        }
        return $booksList;
    }
}