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
                        (<?php   echo $tag['count']; ?>)</a></br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="forum_content">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '/forumTag/_view',
        )); ?>
    </div>
    <div class="anchor"></div>
</div>





