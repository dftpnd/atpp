<div id="breadcrambs">
  <?php echo $html_breadcrambs; ?>
</div>
<div class="create_folder_but" onclick="changeFolder(0, event)">
  Создать папку
</div>
<div class="files_upload"></div>
<div class="files_newfolder"></div>

<ul class="ul_files_actions">
  <li class="files_dowland">
    <div></div>
    <span>Скачать</span>
  </li>
  <li class="files_delete">
    <div></div>
    <span>Удалить</span>
  </li>
  <li class="files_rename">
    <div></div>
    <span>Переименовать</span>
  </li>
</ul>

<div class="table_t table_files">
  <div class="tr_t table_files_head">
    <div class="td_t">
      Название
    </div>
    <div class="td_t">
      Тип
    </div>
    <div class="td_t">
      Изменено
    </div>
    <div class="td_t">
      Область видимости
    </div>
  </div>
  <?php foreach ($folders as $folder): ?>
    <?php
    echo $this->renderPartial('_folder', array(
        'folder' => $folder,
            ), true);
    ?>
  <?php endforeach; ?>

</div>

