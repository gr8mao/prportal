<?php

/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 08.05.17
 * Time: 16:01
 */
class Mail
{
    public static function sentVerifyEmail($to,$id,$key)
    {
        $boundary = md5(uniqid(time()));
        $headers = self::setHeaders($boundary, 'no-replay@pr-portal.ru');

        $msg_body = '
            <h1>Подтвердите регистрацию</h1>

            <h3>Вы зарегистрировались на сайте PR-портал Санкт-Петербургкого Государтсвенного университета телекоммуникаций им. проф. М.А. Бонч-Бруевича. Если это не так, проигноруйте это сообщение, если вы получаете его повторно, свяжитесь с администратором портала.</h3>

            <p><a href="'.URL.'/verifyuser'.$id.'/'.$key.'">'.URL.'/verifyuser'.$id.'/'.$key.'</a>

            <p>С уважением, администрация PR-портала</p>
        ';

        $multipart = self::setMessageBody($boundary, $msg_body);

        $multipart .= "--{$boundary}--\r\n";

        return (mail($to, 'Подтверждение пользователя', $multipart, $headers));
    }


    private static function setHeaders($boundary, $from)
    {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"" . "\r\n";
        $headers .= "From: {$from}" . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return $headers;
    }

    private static function setMessageBody($boundary, $msg_body)
    {
        $multipart = "--{$boundary}\r\n";
        $multipart .= "Content-Type: text/html; charset=\"UTF-8\"" . "\r\n";
        $multipart .= "Content-Transfer-Encoding: base64" . "\r\n\r\n";
        $multipart .= chunk_split(base64_encode($msg_body)) . "\r\n";

        return $multipart;
    }
}