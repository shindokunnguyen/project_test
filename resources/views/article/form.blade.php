<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Manh Hung
 * Date: 11/18/2017
 * Time: 11:48 PM
 */
?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="form-group">
            <strong>Title</strong>
            <input name="art_title" class="form-control" placeholder="title" type="text" value="<?php if (isset($article->title)) echo $article->title; ?>"/>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <div class="form-group">
            <strong>Content</strong>
            <textarea name="art_content" id="art_content"><?php echo isset($article->content) ? $article->content : '' ?></textarea>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-2">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>