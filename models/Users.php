<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 15:33
 */
class Users
{
    const SHOW_BY_DEFAULT = 10;

    public static function registerUser($email, $password, $first_name, $last_name, $group_name)
    {
        $db = Db::getConnection();


        $query = "INSERT INTO Users (Email, Password, First_name, Last_name, Group_name, VerifyKey) VALUES (:email, :password, :first_name, :last_name, :group_name,:key)";

        $encryptedPass = self::encryptPassword($password);
        $key = self::generateVerifyKey($email);
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $encryptedPass, PDO::PARAM_STR);
        $result->bindParam(':first_name', $first_name);
        $result->bindParam(':last_name', $last_name);
        $result->bindParam(':group_name', $group_name);
        $result->bindParam(':key', $key, PDO::PARAM_STR);

        if ($result->execute()) {
            $query = "SELECT id FROM Users WHERE Email = :email LIMIT 1";
            $result = $db->prepare($query);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->execute();
            $id = $result->fetch()['id'];

            Mail::sentVerifyEmail($email,$id, $key);
            return true;
        } else {
            return false;
        }
    }

    public static function generateVerifyKey($email)
    {
        return str_replace('/','',password_hash($email . SECURITY_SALT, PASSWORD_BCRYPT));
    }


    public static function verifyKey($id, $key)
    {
        $db = Db::getConnection();


        $query = "SELECT VerifyKey, Approved FROM Users WHERE id = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $user = $result->fetch();

        if ($key == $user['VerifyKey']) {
            $query = "UPDATE Users SET Approved = 1, VerifyKey='' WHERE id = :id";

            $result = $db->prepare($query);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        }

        return false;
    }

    public static function checkUserData($email, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT id, Email, Password FROM Users WHERE email = :email AND Approved = 1';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->execute();
        // Обращаемся к записи
        $user = $result->fetch();

        if ($user and self::verifyPassword($password, $user['Password'])) {
            // Если запись существует, возвращаем id пользователя
            return self::encryptUserID($user['id']);
        }

        if (!$user['Approved']) {
            return 'not approved';
        }

        return false;
    }

    public static function checkEmailExist($email)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Users` WHERE `Email` = :email";

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();
        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }

    public static function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /*
    * Функция шифрования ID пользователя
    */
    private static function encryptUserID($id)
    {
        return openssl_encrypt($id, 'RC4', SECURITY_KEY, OPENSSL_RAW_DATA);
    }

    /*
    * Функция дешифрования ID пользователя
    */
    private static function decryptUserID($id)
    {
        return openssl_decrypt($id, 'RC4', SECURITY_KEY, OPENSSL_RAW_DATA);
    }

    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return self::decryptUserID($_SESSION['user']);
        }
        return false;
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone <p>Телефон</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param type $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmailExists($email)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM Users WHERE Email = :email';
        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT * FROM Users WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        return $result->fetch();
    }

    public static function getUsernameById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'SELECT `First_name`, `Last_name` FROM Users WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $result = $result->fetch();

        if ($result) {
            return $result['Last_name'] . ' ' . $result['First_name'];
        } else {
            return 'Удаленный пользователь';
        }
    }

    public static function getMaterialCountById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT SUM(c) as summ FROM (SELECT COUNT(*) as c FROM Books as b WHERE b.Added_By = :id UNION ALL SELECT SUM(c2) FROM (SELECT COUNT(*) as c2 FROM Articles as a WHERE a.Added_By = :id UNION ALL SELECT COUNT(*) FROM Movies as m WHERE m.Added_By = :id UNION ALL SELECT COUNT(*) FROM Events as e WHERE e.Added_By = :id) as temp) as result';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch()['summ'];
    }

    public static function editProfilePhoto($id, $path)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE `Users` SET `Image`=:path WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':path', $path, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function deleteProfilePhoto($id)
    {
        $db = Db::getConnection();

        unlink(ROOT . self::getProfilePhotoById($id));

        $sql = 'UPDATE `Users` SET `Image`="/img/users/placeholder-user.png" WHERE `id` = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getProfilePhotoById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT Image as Path FROM Users WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $result = $result->fetch()['Path'];
        if ($result)
            return $result;
        else {
            return '/img/users/placeholder-user.png';
        }
    }


    public static function editProfileInfo($id, $email, $password, $first_name, $last_name, $group_name)
    {
        $db = Db::getConnection();

        if ($password) {
            $query = "UPDATE `Users` SET `Email`=:email,`Password`=:password,`First_name`=:first_name,`Last_name`=:last_name,`Group_name`=:group_nameWHERE id = :id";
            $result = $db->prepare($query);
            $password = self::encryptPassword($password);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
        } else {
            $query = "UPDATE `Users` SET `Email`=:email, `First_name`=:first_name,`Last_name`=:last_name,`Group_name`=:group_name WHERE id = :id";
            $result = $db->prepare($query);
        }

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $result->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $result->bindParam(':group_name', $group_name, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function setAdmin($id)
    {
        $db = Db::getConnection();

        $query = "UPDATE `Users` SET `Role`=1 WHERE id = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function setUser($id)
    {
        $db = Db::getConnection();

        if($id == 1)
        {
            return false;
        }

        $query = "UPDATE `Users` SET `Role`=0 WHERE id = :id";

        $result = $db->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function checkUserAdmin($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT Role as role FROM Users WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($result->fetch()['role'] == 1) {
            return true;
        }
        return false;
    }

    public static function getUsersCount()
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) as c FROM Users';

        $result = $db->prepare($sql);
        $result->execute();

        return $result->fetch()['c'];
    }

    public static function getUsersList($page = 1, $count = self::SHOW_BY_DEFAULT)
    {
        $limit = $count;
        // Смещение (для запроса)
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT * FROM Users ORDER BY id DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function deleteUser($id)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM Users WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function approveUser($id)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE Users SET Approved = 1 WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function approveAllUsers()
    {
        $db = Db::getConnection();

        $sql = 'UPDATE Users SET Approved = 1 WHERE Approved = 0';

        $result = $db->prepare($sql);

        return $result->execute();
    }


    public static function checkLastModify($user, $category)
    {
        if (Users::checkUserAdmin($user)) {
            return true;
        }

        $db = Db::getConnection();

        $query = "SELECT LastModify as last FROM $category WHERE Added_By = :userId ORDER BY id DESC LIMIT 1";

        $result = $db->prepare($query);
        $result->bindParam(':userId', $user, PDO::PARAM_INT);
        $result->execute();

        $time = $result->fetch()['last'];

        if (!$time or $time < time() - 300) {
            return true;
        } else {
            return false;
        }
    }
}