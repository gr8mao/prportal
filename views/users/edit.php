<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 15:57
 */

$title = 'Изменение профиля | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

<!-- Блок регистрации -->
<div class="bloc l-bloc login-bloc bloc-fill-screen bgc-white" id="bloc-95">
    <div class="container">
        <div class="row">
            <img src="/img/pr_logo-white.svg" class="img-responsive center-block mg-md" width="100" />
            <?if($errors):?>
                <div class="col-xs-4 col-xs-offset-4 form-alert">
                    <ul type="none" class="alert alert-danger">
                        <?foreach($errors as $error):?>
                            <li class="alert-danger"><?echo $error?></li>
                        <?endforeach;?>
                    </ul>
                </div>
            <?endif;?>
            <form class="col-xs-4 col-xs-offset-4" method="post" action="#">
                <div class="form-group">
                    <input class="form-control" placeholder="Фамилия" required id="last_name" name="last_name" value="<?echo $userInfo['Last_name']?>"/>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Имя" required id="first_name" name="first_name" value="<?echo $userInfo['First_name']?>"/>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Учебная группа" required id="group_name" name="group_name" value="<?echo $userInfo['Group_name']?>"/>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Почта" required type="email" id="email" name="email" value="<?echo $userInfo['Email']?>"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Пароль" id="password" name="password"  />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Повторите пароль" name="re_password"  id="re_password" />
                </div>
                <input class="btn btn-d pull-right" type="submit" value="Изменить" name="submit"/>
            </form>
        </div>
    </div>
</div>
<!-- КОНЕЦ Блока регистрации -->

<? include_once  ROOT.'/templates/footer.php';?>
