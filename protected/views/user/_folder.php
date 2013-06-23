<div class="tr_t tr_files" folder_id="<?php echo $folder->id; ?>" onclick="openFolder($(this))">
  <div class="td_t files_folder">
    <div></div>
    <span><?php echo $folder->name; ?></span>
  </div>
  <div class="td_t">
    папка
  </div>
  <div class="td_t">
    <?php echo $folder->created; ?>
  </div>
  <div class="td_t">
    <?php echo $folder->private_status; ?>
  </div>
</div>