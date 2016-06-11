<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.06.16
 * Time: 17:09
 */
class UserController
{
    public function actionLogin()
    {
        $email = '';
        $password = '';

        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];

            // check email

            // check password

           $user_info = Users::checkUserData($email,$password);

        }
        include_once ROOT.'/views/users/login.php';
        return true;
    }

    public function actionRegistration()
    {

        $email = '';
        $password = '';
        $re_password = '';
        $first_name = '';
        $last_name = '';
        $group_name = '';

        $errors = false;

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $re_password = $_POST['re_password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $group_name = $_POST['group_name'];

            if ($first_name == '' || $last_name == '' || $group_name == '') {
                $errors[] = 'Заполните все поля!';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Неверный формат электронной почты';
            }

            if (Users::checkEmailExist($email)) {
                $errors[] = 'Такой адрес уже зарезирвирован';
            }

            if (strlen($password) < 6) {
                $errors[] = 'Пароль должен содержать не менее 6 симоволов';
            }

            if ($password !== $re_password) {
                $errors[] = 'Введеные пароли не совпадают';
            }

            if (!$errors) {
                $result = Users::registerUser($email, $password, $first_name, $last_name, $group_name);
                if ($result) {
                    header('Location: /');
                } else {
                    header('Location: error/500');
                }
            }
        }

        include_once ROOT . '/views/users/registation.php';
        return true;
    }

}