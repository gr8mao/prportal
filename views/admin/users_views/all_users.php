<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 17:13
 */

$title = 'Панель администратора | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <h1 class="mg-md text-center">
                    Пользователи в системе
                </h1>
            </div>
            <div class="row">
                <div class="col-sm-offset-8 col-sm-2">
                    <a href="/admin/users/approveAll" type="button"
                       class="btn btn-success center-block"><span
                            class="glyphicon glyphicon-check"></span> Подтвердить всех</a>
                </div>
                <div class="col-sm-2">
                    <a href="/admin" type="button"
                       class="btn btn-default center-block"> Назад</a>
                </div>
                <div class="col-sm-12">
                    <? if ($userList): ?>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Имя</th>
                                <th style="text-align: center">Группа</th>
                                <th style="text-align: center">Роль</th>
                                <th style="text-align: center">Подтвердить</th>
                                <th style="text-align: center">Изменить</th>
                                <th style="text-align: center">Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            <? foreach ($userList as $user): ?>
                                <tr <? if (!$user['Approved']): ?>class="warning"<? endif; ?>
                                    style="text-align: center; vertical-align: baseline;">
                                    <th scope="row"><? echo $user['id']; ?></th>
                                    <td><? echo $user['Email']; ?></td>
                                    <td><? echo $user['First_name'] . ' ' . $user['Last_name']; ?></td>
                                    <td><? echo $user['Group_name']; ?></td>
                                    <td>
                                        <? if ($user['Role'] == 1): ?>
                                            Администратор
                                        <? elseif($user['Role'] == 0): ?>
                                            Пользователь
                                        <? endif; ?>
                                    </td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/users/approve<? echo $user['id']; ?>" type="button"
                                           class="btn btn-sm btn-success"><span
                                                class="glyphicon glyphicon-check"></span></a>
                                    </td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <a href="/admin/users/edit<? echo $user['id']; ?>" type="button"
                                           class="btn btn-sm btn-info"><span
                                                class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    <td style="text-align: center; vertical-align: top;">
                                        <? if ($user['Role'] != 1): ?>
                                            <a href="/admin/users/delete<? echo $user['id']; ?>" type="button"
                                               class="btn btn-sm btn-danger"><span
                                                    class="glyphicon glyphicon-trash"></span></a>
                                        <? endif; ?>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            </tbody>
                        </table>
                        <? if ($pagination): ?>
                            <? echo $pagination->get(); ?>
                        <? endif; ?>
                    <? else: ?>
                        <h3 class="mg-md text-center">
                            Нет пользователей
                        </h3>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- login-bloc END -->
<? include_once ROOT . '/templates/footer.php'; ?>