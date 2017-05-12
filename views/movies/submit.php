<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 04.05.17
 * Time: 12:49
 */

$title = 'Добавить фильм | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

<!-- bloc-24 -->
<div class="bloc b-parallax login-bloc tc-outer-space bgc-white hidden-xs" id="bloc-24" xmlns="http://www.w3.org/1999/html">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-outbox"></span> Добавить фильм
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <div class="panel">
                    <div class="panel-body">
                        <form id="form" method="post" action="#" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">
                                    Название фильма
                                </label>
                                <input id="name" name="name" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="country">
                                    Страна производства
                                </label>
                                <input id="country" name="country" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="genre">
                                    Жанр фильма
                                </label>
                                <input id="genre" name="genre" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="year">
                                    Год
                                </label>
                                <input id="year" name="year" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="link">
                                    Ссылка
                                </label>
                                <input id="link" name="link" class="form-control" type="text"/>
                            </div>
                            <div class="form-group">
                                <label for="annotation">
                                    Аннтация к фильму
                                </label><textarea id="annotation" name="annotation" class="form-control" rows="4" cols="50" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="file">
                                    Обложка
                                </label> <input id="file" name="file" class="form-control" type="file"/>
                            </div>
                            <input class="btn btn-d btn-lg btn-block" type="submit"  name="submit" id="submit"/>
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
