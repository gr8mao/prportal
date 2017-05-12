<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 9:25
 */
class Events
{
    const SHOW_BY_DEFAULT = 10;

    public static function getEventList()
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM Events WHERE Date_start >= CURRENT_DATE AND Approved = 1 ORDER BY Date_start ASC';

        $result = $db->prepare($query);
        $result->execute();

        $RuMonth = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $EnMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $eventsList = array();
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $eventsList[$i]['id'] = $row['id'];
            $eventsList[$i]['Name'] = $row['Name'];
            $eventsList[$i]['Month'] = $row['Month'];
            $date = new DateTime($row['Date_start']);
            $eventsList[$i]['Date_start'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
            if ($row['Date_end'] != '0000-00-00') {
                $date = new DateTime($row['Date_end']);
                $eventsList[$i]['Date_end'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
            }
            $date = new DateTime($row['Date_start']);
            $eventsList[$i]['Month_name'] = str_replace($EnMonth, $RuMonth, $date->format('F'));
            $i += 1;
        }

        return $eventsList;
    }

    public static function saveEvent($name, $date_start, $date_end, $annotation, $place, $link, $image, $added_by)
    {
        $db = Db::getConnection();

        if(Users::checkUserAdmin($added_by)){
            $query = 'INSERT INTO `Events`(`Name`, `Date_start`, `Date_end`, `Month`, `Annotation`, `Place`, `Link`, `Image`, `Added_By`, `LastModify`, `Approved`) VALUES (:name,:date_start,:date_end,:month,:annotation,:place,:link,:image,:added_by,:LastModify,1)';
        } else {
            $query = 'INSERT INTO `Events`(`Name`, `Date_start`, `Date_end`, `Month`, `Annotation`, `Place`, `Link`, `Image`, `Added_By`, `LastModify`) VALUES (:name,:date_start,:date_end,:month,:annotation,:place,:link,:image,:added_by,:LastModify)';
        }

        $month = (new DateTime($date_start))->format('n');

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_start', $date_start, PDO::PARAM_STR);
        $result->bindParam(':date_end', $date_end, PDO::PARAM_STR);
        $result->bindParam(':month', $month, PDO::PARAM_INT);
        $result->bindParam(':annotation', $annotation, PDO::PARAM_STR);
        $result->bindParam(':place', $place, PDO::PARAM_STR);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':added_by', $added_by, PDO::PARAM_INT);
        $result->bindParam(':LastModify', $time, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getEventById($id)
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM Events WHERE id = :id';

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $RuMonth = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $EnMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $eventList = array();
        $row = $result->fetch();
        $eventList['id'] = $row['id'];
        $eventList['Name'] = $row['Name'];
        $date = new DateTime($row['Date_start']);
        $eventList['Date_start'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
        if ($row['Date_end'] != '0000-00-00') {
            $date = new DateTime($row['Date_end']);
            $eventList['Date_end'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
        }
        $eventList['Annotation'] = $row['Annotation'];
        $eventList['Place'] = $row['Place'];
        $eventList['Link'] = $row['Link'];
        $eventList['Image'] = $row['Image'];
        $eventList['Added_By'] = $row['Added_By'];

        return $eventList;
    }

    public static function getEvent($id)
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM Events WHERE id = :id';

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    public static function getEventsByUserId($id)
    {
        $db = Db::getConnection();

        $query = 'SELECT * FROM Events WHERE Date_start >= CURRENT_DATE AND Approved = 1 AND Added_By = :id ORDER BY Date_start ASC';

        $result = $db->prepare($query);
        $result->bindParam(':id',$id,PDO::PARAM_INT);
        $result->execute();

        $RuMonth = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        $EnMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $eventsList = array();
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            $eventsList[$i]['id'] = $row['id'];
            $eventsList[$i]['Name'] = $row['Name'];
            $eventsList[$i]['Month'] = $row['Month'];
            $date = new DateTime($row['Date_start']);
            $eventsList[$i]['Date_start'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
            if ($row['Date_end'] != '0000-00-00') {
                $date = new DateTime($row['Date_end']);
                $eventsList[$i]['Date_end'] = str_replace($EnMonth, $RuMonth, $date->format('F, j'));
            }
            $date = new DateTime($row['Date_start']);
            $eventsList[$i]['Month_name'] = str_replace($EnMonth, $RuMonth, $date->format('F'));
            $i += 1;
        }

        return $eventsList;
    }

    public static function getEvents($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM Events ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getEventsCount(){
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) as c FROM `Events` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetch()['c'];

        return $result;
    }

    public static function approveAllEvents(){
        $db = Db::getConnection();

        $query = "UPDATE `Events` SET Approved = 1 WHERE Approved = 0";

        $query = $db->prepare($query);

        $result = $query->execute();

        return $result;
    }

    public static function approveEventById($id){
        $db = Db::getConnection();

        $query = "UPDATE `Events` SET Approved = 1 WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function deleteEventById($id){
        $db = Db::getConnection();

        $query = "DELETE FROM `Events` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function editEvent($id, $name, $date_start, $date_end, $annotation, $place, $link, $image)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Events` SET `Name`=:name, `Date_start`=:date_start, `Date_end`=:date_end, `Month`=:month, `Annotation`=:annotation, `Place`=:place, `Link`=:link, `Image`=:image, `LastModify`=:LastModify WHERE id = :id";

        $month = (new DateTime($date_start))->format('n');

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':LastModify', $time, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':date_start', $date_start, PDO::PARAM_STR);
        $result->bindParam(':date_end', $date_end, PDO::PARAM_STR);
        $result->bindParam(':month', $month, PDO::PARAM_INT);
        $result->bindParam(':annotation', $annotation, PDO::PARAM_STR);
        $result->bindParam(':place', $place, PDO::PARAM_STR);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);

        $result = $result->execute();

        return $result;
    }
}