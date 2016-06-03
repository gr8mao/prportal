<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.06.16
 * Time: 20:22
 */

$title = "Книги | PR-портал";
include_once ROOT.'/templates/header.php'; ?>

<!-- bloc-10 -->
<div class="bloc b-parallax l-bloc books-bloc bgc-white" id="bloc-10">
    <div class="container bloc-lg">
        <div class="row hidden-xs">
            <div class="col-sm-6">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-book"></span> Книги
                </h1>
            </div>
            <div class="col-sm-6">
                <a href="#" class="btn btn-lg pull-right btn-white hidden-xs">
                    <span class="feather-icon icon-plus icon-spacer"></span>Добавить книгу</a>
            </div>
        </div>
        <div class="row voffset">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white text-center hidden-sm hidden-lg hidden-md">
                    <span class="feather-icon icon-book"></span> Книги
                </h1>
            </div>
        </div>
        <?if($books):?>
        <div class="row voffset">
            <?foreach($books as $book):?>
            <div class="col-sm-3" >
                <div class="panel" height="200px">
                    <div class="panel-heading" id="movie3">
                        <a href="#"><img src="/img/books/book<?echo $book['id'];?>.jpg" class="mg-sm center-block img-responsive" id="movie3cover" /></a>
                        <form id="form_1069" novalidate>
                            <div class="form-group">
                                <label>
                                    <?echo $book['Author'];?>
                                </label>
                            </div>
                        </form>
                        <h4 class="mg-clear text-center">
                            <?echo $book['Title'];?>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <a href="#" class="btn  btn-d btn-rd" id="movie3button">Подробнее...</a>
                        </div>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
        <?else:?>
            <div class="row voffset-lg">
                <div class="col-sm-12">
                    <h4 class="mg-md text-center tc-white">
                        <i>Книг пока нет...</i>
                    </h4>
                </div>
            </div>
        <?endif;?>
    </div>
</div>
<!-- bloc-10 END -->

<? include_once ROOT.'/templates/footer.php';?>
