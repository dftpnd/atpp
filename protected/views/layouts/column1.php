<?php $this->beginContent('/layouts/main'); ?>
<?php
//var_dump($this->id);die();
if($this->id == 'forum'){
    $dop_class = 'fc_important';
}else{
    $dop_class = '';
}
?>
<div class="container">
    <div id="content" class="<?php echo $dop_class; ?>">
        <?php echo $content; ?>
    </div><!-- content -->
</div>
<?php $this->endContent(); ?>