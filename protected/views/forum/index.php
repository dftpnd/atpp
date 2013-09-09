<?php if (isset($_GET['tag_id'])): ?>
    <a href="/forum/index" class="classic">Убрать сортировку</a>
<?php endif; ?>


<div class="" style="height: 100px;">

</div>
<?php if (!Yii::app()->user->isGuest): ?>
    <div class="create_forum" onclick="openUpdateForum(0)"><input type="submit" value="Задать вопрос"/></div>
<?php endif; ?>
<div class="anchor"></div>
<div class="forum_area">
    <div class="forum_tag">
        <div class="forum_tag_obert">
            <h3>Список тэгов:</h3>
            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag_id => $tag): ?>
                    <a href="/forum/index?tag_id=<?php echo $tag_id; ?>">#<?php echo $tag['name']; ?>
                        (<?php echo $tag['count']; ?>)</a></br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="forum_content">
        <?php if (!empty($forums)): ?>
            <?php foreach ($forums as $forum): ?>
                <div class="forum">
                    <h1><a href='/forum/view?id=<?php echo $forum->id ?>'><?php echo $forum->title; ?></a></h1>

                    <div class="forum_date">
                        <?php
                        $m = date('m', $forum->created);
                        $j = date('j', $forum->created);
                        $y = date('Y', $forum->created);
                        ?>
                        <?php echo $j . ' ' . MyHelper::getRusMonth($m) . ' ' . $y; ?>
                    </div>
                    <a class="classic" href="/user/ViewProfile"><?php echo MyHelper::getUsername($forum->user_id) ?></a>

                    <div class="forum_content_text">
                        <?php echo $forum->content; ?>
                    </div>
                    <div class="forum_content_tags">

                        <?php foreach ($forum->forum_tag as $tag_forum): ?>
                            <?php if (isset($tag_forum->tag)): ?>
                                <a href="/forum/index?tag_id=<?php echo $tag_forum->tag->id; ?>">#<?php echo $tag_forum->tag->name; ?></a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
    ));?>
    <div class="anchor"></div>
</div>





