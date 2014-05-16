<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '/forumTag/_view',
    'cssFile' => false,
    'template' => "{items}",
    'pager' => array(
        'cssFile' => false
    )
));
?>
<?php if (count($comments) > 0): ?>
    <h1>Комментарии:</h1>
    <a name="comments"></a>
<?php endif; ?>
<?php
//all comment

foreach ($comments as $comment) {
    $this->renderPartial('_view_comment',
        array(
            'comment' => $comment,
        ));
}



?>

<?php if (Yii::app()->user->isGuest): ?>
    <div style="margin-left: 150px">Только зарегистрированные пользователи могут оставлять комментарии. <span
            class="classic"
            onclick='EnterSite()'>Войдите</span>,
        пожалуйста.
    </div>
<?php else: ?>
    <?php $this->renderPartial('_new_comment', array(
        'forum_id' => $forum_id
    )); ?>
<?php endif; ?>