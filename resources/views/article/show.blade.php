<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Manh Hung
 * Date: 11/18/2017
 * Time: 11:49 PM
 */
?>
@extends('layouts.app')

@section('content')

    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <textarea class="form-control" id="content"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn actionBtn" data-dismiss="modal" id="btn-comment" 
                                onclick="ArticleController.Comment();">
                            <span id="footer_action_button" class=''> Comment </span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class=''></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end modal -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="display: inline-flex; width: 100%">
                {{ csrf_field() }}
                <div class="panel-heading">
                    <h4>Detail article</h4>
                </div>
                <div class="panel-heading" id="article_like">
                    <?php if ($isLike == 1) { ?>
                        <a class="btn btn-custom" href="javascript:void(0)" onclick="ArticleController.ArticleLike();" id="un_like_btn" style="display: block;">UnLike</a>
                        <a class="btn btn-primary" href="javascript:void(0)" onclick="ArticleController.ArticleLike();" id="like_btn" style="display: none">Like</a>
                    <?php } else { ?>
                        <a class="btn btn-custom" href="javascript:void(0)" onclick="ArticleController.ArticleLike();" id="un_like_btn" style="display: none;">UnLike</a>
                        <a class="btn btn-primary" href="javascript:void(0)" onclick="ArticleController.ArticleLike();" id="like_btn" style="display: block">Like</a>
                    <?php } ?>
                    <input type="hidden" value="{{$isLike}}" id="like_value" />
                    <input type="hidden" value="{{$article->id}}" id="art_id" />
                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id" />
                </div>
                <div class="panel-heading">
                    <a class="btn btn-primary" id="btn_comment_art" href="javascript:void(0)" 
                        onclick="ArticleController.OpenOVLCommnet();">Comment Article</a>
                </div>
                <?php if ($article->author == Auth::user()->id) { ?>
                    <div class="panel-heading">
                        <a class="btn btn-primary" href="{{route('articles.edit', $article->id)}}">Edit Article</a>
                    </div>
                    <div class="panel-heading">
                        <a class="btn btn-primary" href="{{route('articles.destroy', $article->id)}}">Delete Article</a>
                    </div>
                <?php } ?>
            </div>
            
            <div class="alert alert-success" id="alert-success" style="display: none"></div>
      
        </div>

        <div class="col-md-8 col-md-offset-2 bg-content">
            <h3><?php echo isset($article->title) ? ($article->title) : '' ?></h3>
            <br>
            <p>
                <?php echo isset($article->content) ? ($article->content) : '' ?>
            </p>
        </div>

        <div class="col-md-8 col-md-offset-2" style="margin-top: 10px">
            
            <div class="panel panel-default" style="margin-bottom: 1px !important">
                <?php $pleaseComment = ''; 
                    if (count($listComment) == 0) {
                    $pleaseComment = 'Be the first to comment on this article';
                } ?>
                <p><h5 style="margin-left: 5px">Comments: <i><?php echo $pleaseComment; ?></i></h5></p>
            </div>
            <div id="list-comment">
                <?php if (count($listComment) > 0 ) { ?>
                    <?php foreach ($listComment as $key => $comment) { ?>
                        <div class=" bg-comment" style="margin-top: 5px">
                            <span style="color: blue"><?php echo $comment->user_name; ?></span> (<i><?php  echo str_replace('-', '/', substr($comment->created_at, 0, 16)) ?></i>)
                            <p style="margin-left: 5px"><?php echo isset($comment->content) ? (nl2br($comment->content)) : '' ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                
            </div>
        </div>

    </div>

@endsection

