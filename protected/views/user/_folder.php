<div class="tr_t tr_files" folder_id="<?php echo $folder->id; ?>" onclick="activeFolder(this)" >
  <div class="td_t files_folder">
    <div></div>
    <span  onclick="openFolder($(this), event)" ><?php echo $folder->name; ?></span>
  </div>
  <div class="td_t">
    <span>папка</span>
  </div>
  <div class="td_t">

    <?php echo date('j', $folder->created); ?>

    <?php echo MyHelper::getRusMonth((int) date('n', $folder->created)) ?>

    <?php echo date('y', $folder->created); ?>
  </div>
  <div class="td_t">
    <?php echo 
    CHtml::dropDownList(
            "Folder[private_status]", $folder->private_status, CHtml::listData($private_status, 'id', 'name')
    );
    ?>
  </div>
</div>