<?php if (isset($_GET['tag_id'])): ?>
    <a href="/forum/index" class="classic" async="async" >Убрать сортировку</a>
<?php endif; ?>

<?php if (!Yii::app()->user->isGuest): ?>
    <div class="create_forum" onclick="openUpdateForum(0)"><input type="submit" value="Создать обсуждение"/></div>
<?php endif; ?>
<div class="anchor"></div>
<div class="forum_area">
    <div class="forum_tag">
        <div class="forum_tag_obert">
            <h3>Список тэгов:</h3>
            <?php if (!empty($tags)): ?>
                <?php foreach ($tags as $tag_id => $tag): ?>
                    <a async="async" href="/forum/index?tag_id=<?php echo $tag_id; ?>">#<?php echo $tag['name']; ?>
                        (<?php echo $tag['count']; ?>)</a></br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="forum_content">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '/forumTag/_view',
            'cssFile' => false,
            'template' => '{pager} {items}  {pager}',
            'pager' => array(
                'cssFile' => false
            )
        )); ?>
    </div>
    <div class="anchor"></div>
</div>

