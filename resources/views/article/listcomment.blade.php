<?php if (count($listComment) > 0 ) { ?>
    <?php foreach ($listComment as $key => $comment) { ?>
        <div class=" bg-comment" style="margin-top: 5px">
            <span style="color: blue"><?php echo $comment->user_name; ?></span> (<i><?php  echo str_replace('-', '/', substr($comment->created_at, 0, 16)) ?></i>)
            <p style="margin-left: 5px"><?php echo isset($comment->content) ? (nl2br($comment->content)) : '' ?></p>
        </div>
    <?php } ?>
<?php } ?>