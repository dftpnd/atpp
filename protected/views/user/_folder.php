<div class="folder_user private_status_<?php echo $folder->private_status; ?>" folder_id="<?php echo $folder->id; ?>" onclick="openFolder($(this))">
  <div class="folder_but">
    <div class="folder_delete" onclick="changeFolder(<?php echo $folder->id; ?>, event)"></div>
    <div class="folder_edit" onclick="deleteFolder(<?php echo $folder->id; ?>, event)"></div>
  </div>
  <span class="text_val"><?php echo $folder->name; ?></span>
</div>