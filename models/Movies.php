<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.05.17
 * Time: 17:49
 */
class Movies
{
    const SHOW_BY_DEFAULT = 10; // проверить константы

    public static function getLatestMovies()
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Movies` WHERE Approved = 1 ORDER BY `id` DESC";

        $result = $db->query($query);

        $moviesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $moviesList[$i]['id'] = $row['id'];
            $moviesList[$i]['Name'] = $row['Name'];
            $moviesList[$i]['Country'] = $row['Country'];
            $moviesList[$i]['Year'] = $row['Year'];
            $moviesList[$i]['image_path'] = $row['Image'];
            $i += 1;
        }
        return $moviesList;
    }

    public static function saveMovie($name, $country, $year, $annotation, $genre, $image, $link, $added_by)
    {
        $db = Db::getConnection();

        if ($db) {

            if(Users::checkUserAdmin($added_by)){
                $query = "INSERT INTO `Movies`(`Name`, `Country`, `Year`, `Annotation`, `Genre`, `Added_By`, `Image`, `Link`, `LastModify`, `Approved`) VALUES (:name,:country,:year,:annotation,:genre,:added_by,:image,:link,:LastModify,1)";
            } else {
                $query = "INSERT INTO `Movies`(`Name`, `Country`, `Year`, `Annotation`, `Genre`, `Added_By`, `Image`, `Link`, `LastModify`) VALUES (:name,:country,:year,:annotation,:genre,:added_by,:image,:link,:LastModify)";

            }

            $time = time();
            $result = $db->prepare($query);
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':country', $country, PDO::PARAM_STR);
            $result->bindParam(':year', $year, PDO::PARAM_STR);
            $result->bindParam(':annotation', $annotation, PDO::PARAM_STR);
            $result->bindParam(':genre', $genre, PDO::PARAM_STR);
            $result->bindParam(':added_by', $added_by, PDO::PARAM_INT);
            $result->bindParam(':LastModify', $time, PDO::PARAM_INT);
            $result->bindParam(':image', $image, PDO::PARAM_STR);
            $result->bindParam(':link', $link, PDO::PARAM_STR);

            return $result->execute();
        }
    }

    public static function getMovieByID($id)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Movies` WHERE `id` = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    public static function getMoviesByUserId($id)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Movies` WHERE `Approved`=1 AND Added_By = :id ORDER BY `id` DESC";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $moviesList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $moviesList[$i]['id'] = $row['id'];
            $moviesList[$i]['Name'] = $row['Name'];
            $moviesList[$i]['Country'] = $row['Country'];
            $moviesList[$i]['Year'] = $row['Year'];
            $moviesList[$i]['image_path'] = $row['Image'];
            $i += 1;
        }
        return $moviesList;
    }

    public static function getMovies($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM Movies ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMoviesCount()
    {
        $db = Db::getConnection();

        $query = "SELECT COUNT(*) as c FROM `Movies` ORDER BY `id` DESC";

        $query = $db->query($query);

        $result = $query->fetch()['c'];

        return $result;
    }

    public static function approveAllMovies()
    {
        $db = Db::getConnection();

        $query = "UPDATE `Movies` SET Approved = 1 WHERE Approved = 0";

        $query = $db->prepare($query);

        $result = $query->execute();

        return $result;
    }

    public static function approveMovieById($id)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Movies` SET Approved = 1 WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function deleteMovieById($id)
    {
        $db = Db::getConnection();

        $query = "DELETE FROM `Movies` WHERE id = :id";

        $query = $db->prepare($query);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();

        return $result;
    }

    public static function editMovie($id, $name, $country, $year, $annotation, $genre, $image, $link)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Movies` SET `Name`=:name, `Country`=:country, `Year`=:year, `Annotation`=:annotation, `Genre`=:genre, `Image`=:image, `Link`=:link, `LastModify`=:LastModify WHERE id = :id";

        $time = time();
        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':LastModify', $time, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':country', $country, PDO::PARAM_STR);
        $result->bindParam(':year', $year, PDO::PARAM_STR);
        $result->bindParam(':annotation', $annotation, PDO::PARAM_STR);
        $result->bindParam(':genre', $genre, PDO::PARAM_STR);
        $result->bindParam(':image', $image, PDO::PARAM_STR);
        $result->bindParam(':link', $link, PDO::PARAM_STR);

        $result = $result->execute();

        return $result;
    }
}