<?php
$m = date('m', $comment->created);
$j = date('j', $comment->created);
$y = date('Y', $comment->created);

$my_picter = Yii::app()->createAbsoluteUrl('i/avatar.png');
if (!is_null($comment->user->prof->file_id)) {
    $file_name = $comment->user->prof->uploadedfiles->name;
    $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
}

?>





<div class="forum_comment">
    <div class="datef"><?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?></div>
    <div class="table_t user-forum-comment">
        <div class="tr_t">
            <div class="td_t udc-1">
                <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $comment->user->prof->id)), array('async' => 'async', 'class' => 'circle_picter')); ?>
                <a href="#" class="clasic"><?php echo MyHelper::getUsername($comment->user_id); ?></a>
            </div>
            <div class="td_t udc-2">
                <?php echo $comment->text; ?>
            </div>
        </div>
    </div>

</div>