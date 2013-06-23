<?php if ($new): ?>
  <?php $status_class = 'st_new'; ?>
<?php else: ?>
  <?php $status_class = 'st_old'; ?>
<?php endif; ?>


<div class="tr_t tr_files  <?php echo $status_class; ?>" folder_id="<?php echo $folder->id; ?>" onclick="activeFolder($(this))" >
  <div class="td_t files_folder">
    <div></div>
    <span class="edet_block">
      <input type="text" class="name_folder"  name="Folder[name]"/>
      <input type="hidden" value="<?php echo (int) $folder->id; ?>" name="folder_id">
      <input type="hidden" value="<?php echo $folder->parent_id; ?>" name="Folder[parent_id]">
    </span>
    <span class="show_block">
      <span  onclick="openFolder($(this), event)" class="">
        <?php echo $folder->name; ?>
      </span>
    </span>
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
    <span class="edet_block">
      <?php
      echo
      CHtml::dropDownList(
              "Folder[private_status]", $folder->private_status, CHtml::listData($private_status, 'id', 'name')
      );
      ?>
    </span>
    <span class="show_block">
      <?php echo $folder->ps->name; ?>
    </span>
  </div>
</div>