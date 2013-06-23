<div id="breadcrambs">
  <?php echo $html_breadcrambs; ?>
</div>

<div class="create_folder_but" onclick="changeFolder(0, event)">
  Создать папку
</div>
<div class="user_files">
  <?php foreach ($folders as $folder): ?>
    <?php
    echo $this->renderPartial('_folder', array(
        'folder' => $folder,
            ), true);
    ?>
  <?php endforeach; ?>
</div>
