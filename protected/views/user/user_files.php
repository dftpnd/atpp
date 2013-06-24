<div id="breadcrambs">
  <?php echo $html_breadcrambs; ?>
</div>

<div class="files_upload"></div>
<div class="files_newfolder" onclick="changeFolder(0, event)" title="Создать папку"></div>

<div class="mydropbox">
  <ul class="ul_files_actions">
    <li class="files_dowland">
      <div></div>
      <span>Скачать</span>
    </li>
    <li class="files_delete">
      <div></div>
      <span>Удалить</span>
    </li>
    <li class="files_rename" onclick="editLineFolder()" >
      <div></div>
      <span >Изменить</span>
    </li>
  </ul>

  <div class="table_t table_files">
    <div class="table_head_t">
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
    </div>
    <div class="table_body_t">
      <?php foreach ($folders as $folder): ?>
        <?php
        echo $this->renderPartial('_folder', array(
            'folder' => $folder,
            'private_status' => $private_status,
            'new' => $new
                ), true);
        ?>
      <?php endforeach; ?>
    </div>
  </div>
</div>