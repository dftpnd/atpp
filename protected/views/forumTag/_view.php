<?php
$my_picter = Yii::app()->createAbsoluteUrl('i/mini_avatar.png');
if (!is_null($data->forum->user->prof->file_id)) {
    $file_name = $data->forum->user->prof->uploadedfiles->name;
    $my_picter = Yii::app()->createAbsoluteUrl('uploads/avatar/avatar_' . $file_name);
}
$m = date('m', $data->forum->created);
$j = date('j', $data->forum->created);
$y = date('Y', $data->forum->created);
?>

<div class="forum">
    <div class="forum_date">
        <?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?>
    </div>

    <div class="forum_grid">
        <div class="forum_grid_info">
            <div class="forum_grid_block">

                <?php echo CHtml::link("<img  src='$my_picter' />", Yii::app()->urlManager->createUrl('/user/ViewProfile', array('id' => $data->forum->user->prof->id)), array('async' => 'async', 'class' => 'circle_picter')); ?>
                <a async="async" class="classic" href="/user/ViewProfile"><?php echo MyHelper::getUsername($data->forum->user_id) ?></a>


            </div>
        </div>
        <div class="forum_grid_content">
            <div class="forum_grid_block">
                <h1><a async="async" href='/forum/view?id=<?php echo $data->forum->id ?>' class="classic"><?php echo $data->forum->title; ?></a></h1>

                <div class="forum_content_text">
                    <?php echo MyHelper::makeClickableLinks($data->forum->content); ?>
                </div>

                <div class="forum_comment_count">
                    <a async="async" href="/forum/view?id=<?php echo $data->forum->id; ?>#comments"><?php echo MyHelper::commentCount($data->forum->id); ?>
                        Коментария</a>
                </div>
            </div>
        </div>
    </div>

    <div class="anchor"></div>


    <div class="forum_content_tags">
        <?php $tegs = MyHelper::forumTag($data->forum->id); ?>

        <?php foreach ($tegs as $tag): ?>
            <?php if (isset($tag)): ?>
                <a async="async" href="/forum/index?tag_id=<?php echo $tag->tag->id; ?>">#<?php echo $tag->tag->name; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


</div>