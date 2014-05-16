<?php
$m = date('m', $comment->created);
$j = date('j', $comment->created);
$y = date('Y', $comment->created);
$default = true;
$my_picter = Yii::app()->createAbsoluteUrl('i/avatar.png');
if (!is_null($comment->user->prof->file_id)) {
    $file_name = $comment->user->prof->uploadedfiles->name;
    $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/mini_' . $file_name);
    $default = false;
}
$dop_srtyle = $default ? 'width=45px' : '';
?>





<div class="forum_comment">
    <div class="table_t user-forum-comment">

        <?php if (!Yii::app()->user->isGuest && $comment->user_id == Yii::app()->user->id): ?>
            <div class="delete_forum" style="float: right"
                 onclick="commentForumDelete(<?php echo $comment->id; ?>)">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Icon"
                     x="0px" y="0px" width="20px" height="20px" viewBox="0 0 100 100"
                     enable-background="new 0 0 100 100"
                     xml:space="preserve">
                <g>
                    <path fill="#999"
                          d="M88.184,81.468c1.167,1.167,1.167,3.075,0,4.242l-2.475,2.475c-1.167,1.167-3.076,1.167-4.242,0   l-69.65-69.65c-1.167-1.167-1.167-3.076,0-4.242l2.476-2.476c1.167-1.167,3.076-1.167,4.242,0L88.184,81.468z"/>
                </g>
                    <g>
                        <path fill="#999"
                              d="M18.532,88.184c-1.167,1.166-3.076,1.166-4.242,0l-2.475-2.475c-1.167-1.166-1.167-3.076,0-4.242   l69.65-69.651c1.167-1.167,3.075-1.167,4.242,0l2.476,2.476c1.166,1.167,1.166,3.076,0,4.242L18.532,88.184z"/>
                    </g>
            </svg>
            </div>
        <?php endif; ?>
        <div class="triangle-left"></div>

        <?php echo CHtml::link("<img  src='{$my_picter}' {$dop_srtyle} />", Yii::app()->urlManager->createUrl("/user/ViewProfile", array('id' => $comment->user->prof->id)), array('async' => 'async', 'class' => 'circle_picter')); ?>
        <a href="/user/ViewProfile/<?php echo $comment->user->prof->id; ?>"
           class="clasic"><?php echo MyHelper::getUsername($comment->user_id); ?></a>
        <span class="ufc-date"><?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?></span>

        <div class="anchor"></div>
        <div class="ufc-content">
            <?php echo MyHelper::makeClickableLinks($comment->text); ?>
        </div>
    </div>
</div>