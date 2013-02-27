<script>
    $(function() {
        $('#gallery a').lightBox();
    }); 
</script>
<?php
$more = getenv("HTTP_REFERER");
$post_now = 'http://' . $_SERVER['SERVER_NAME'] . '/post/' . $model->id . '?title=' . $model->title;
if ($more != $post_now) {
    echo CHtml::link('Прочитать статью', Yii::app()->urlManager->createUrl('post/' . $model->id . '?title=' . $model->title), array('class' => 'huas'));
}
?><br>
<?php
?>
<?php echo CHtml::link('Вернуться назад', "javascript: history.go(-1)", array('class' => 'feadback', 'id' => '')); ?>
<div class="reset"></div>
<div id="gallery" >
    <ul>

        <?php
        $i = 1;
        foreach ($model->filetopost as $ftp) {
            //echo $ftp->file->name;
            //var_dump(is_null($ftp->file));
            if ($ftp->file->invisible != 1) {
                if ($ftp->file != null) {
                    echo '<li><a href="../../uploads/oli_' . ($ftp->file->name) . '" rel="lightbox[roadtrip]" ><img  index="' . $i++ . '" src="../../uploads/thumb_' . ($ftp->file->name) . ' "/></a></li>';
                }
            }
        }
        ?>
    </ul>
    <div class="anchor"></div>
    <!--    <div class="reset"></div>-->
</div>
<div class="reset"></div>



