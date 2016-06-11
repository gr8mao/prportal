<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 15:33
 */
class Users
{
    public static function isGuest()
    {

    }

    public static function registerUser($email, $password, $first_name, $last_name, $group_name)
    {
        $db = Db::getConnection();


        $query = "INSERT INTO Users (Email, Password, First_name, Last_name, Group_name) VALUES (:email, :password, :first_name, :last_name, :group_name)";

        $encryptedPass = self::encryptPassword($password);
        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $encryptedPass, PDO::PARAM_STR);
        $result->bindParam(':first_name', $first_name);
        $result->bindParam(':last_name', $last_name);
        $result->bindParam(':group_name', $group_name);

        return $result->execute();
    }

    public static function editBioInfo()
    {

    }

    public static function editUserInfo()
    {

    }

    public static function editImgProfile()
    {

    }

    public static function logout()
    {

    }

    public static function login()
    {

    }


    public static function checkUserData($email){
        $db = Db::getConnection();

        $query = "SELECT * FROM Users WHERE Email = :email AND Password =";

        $result = $db->prepare($query);
        $result->bindParam(':email',$email,PDO::PARAM_STR);

        $result->execute();

        return $result->fetchColumn(2);
    }

    public static function checkEmailExist($email)
    {
        $db = Db::getConnection();

        $query = "SELECT * FROM `Users` WHERE `Email` = :email";

        $result = $db->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        $result->execute();
        if($result->fetchColumn()){
            return true;
        }
        return false;
    }

    public static function encryptPassword($password){
        return password_hash($password,PASSWORD_BCRYPT);
    }
}