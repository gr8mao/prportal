<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.16
 * Time: 19:27
 */
$title = 'Оставть комментарий к книге | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

<!-- bloc-24 -->
<div class="bloc b-parallax login-bloc tc-outer-space bgc-white hidden-xs" id="bloc-24" xmlns="http://www.w3.org/1999/html">
    <div class="container bloc-lg" style="padding-top: 50px;">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-outbox"></span> Добавить рецензию к книге
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div class="panel">
                    <div class="panel-body">
                        <form id="form" method="post" action="#">
                            <div class="form-group">
                                <label for="group">
                                    Заголовок рецензии
                                </label>
                                <input id="group" name="title" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="content">
                                    Текст рецензии
                                </label><textarea id="content" name="comment" class="form-control" rows="4" cols="50" required></textarea>
                            </div>
                            <input class="btn btn-d btn-lg btn-block" type="submit"  name="submit" id="submit" value="Отправить"/>
                        </form>
                        <?if($errors):?>
                            <div class="form-alert">
                                <h4 class=" alert alert-danger">Найдены ошибки при заполнении!</h4>
                                <ul type="none" class="alert alert-danger">
                                    <?foreach($errors as $error):?>
                                        <li class="alert-danger"><?echo $error?></li>
                                    <?endforeach;?>
                                </ul>
                            </div>
                        <?endif;?>
                        <?if($errors === false):?>
                            <div class="form-alert">
                                <h4 class=" alert alert-success">Ваша статья успешно добавлена в базу!</h4>
                            </div>
                        <?endif;?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- bloc-24 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
