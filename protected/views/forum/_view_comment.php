<div class="forum_comment">
    <?php echo $comment->text; ?><br/>
    <?php echo $comment->created; ?><br/>
    <a href="#" class="classic"><?php echo MyHelper::getUsername($comment->user_id); ?></a>
</div>