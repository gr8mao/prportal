<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:47
 */


$title = 'Отправить статью | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

    <!-- bloc-24 -->
    <div class="bloc b-parallax login-bloc tc-outer-space bgc-white hidden-xs" id="bloc-24"
         xmlns="http://www.w3.org/1999/html">
        <div class="container bloc-lg">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="mg-md tc-white">
                        <span class="feather-icon icon-outbox"></span> Прислать работу
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-md-offset-3">
                    <div class="panel">
                        <div class="panel-body">
                            <form id="form" method="post" action="#">
                                <div class="form-group">
                                    <label for="title">
                                        Заголовок статьи
                                    </label>
                                    <input name="title" id="title" type="text" class="form-control" required value="<?echo $article['Title'];?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="content">
                                        Текст статьи
                                    </label><textarea id="content" name="content" class="form-control" rows="4" cols="50" required>"<?echo $article['Content']?>"</textarea>
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