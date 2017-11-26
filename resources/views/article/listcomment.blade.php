<?php if (count($listComment) > 0 ) { ?>
    <?php foreach ($listComment as $key => $comment) { ?>
        <div class=" bg-comment" style="margin-top: 5px">
            <p style="margin-left: 5px"><?php echo isset($comment->content) ? htmlspecialchars($comment->content) : '' ?></p>
        </div>
    <?php } ?>
<?php } ?>