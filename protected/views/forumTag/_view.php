<div class="forum">
    <h1><a href='/forum/view?id=<?php echo $data->forum->id ?>'><?php echo $data->forum->title; ?></a></h1>
    <div class="forum_date">
        <?php
        $m = date('m', $data->forum->created);
        $j = date('j', $data->forum->created);
        $y = date('Y', $data->forum->created);
        ?>
        <?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?>
    </div>
    <a class="classic" href="/user/ViewProfile"><?php echo MyHelper::getUsername($data->forum->user_id) ?></a>

    <div class="forum_content_text">
        <?php echo $data->forum->content; ?>
    </div>
    <div class="forum_content_tags">
        <?php $tegs = MyHelper::forumTag($data->forum->id); ?>

        <?php foreach ($tegs as $tag): ?>
            <?php if (isset($tag)): ?>
                <a href="/forum/index?tag_id=<?php echo $tag->tag->id; ?>">#<?php echo $tag->tag->name; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>