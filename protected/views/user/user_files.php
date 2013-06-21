<ul>
  <li>
    красный(1) - только мне
  </li>
  <li>
    синий(2) - мне и студентам
  </li>
  <li>
    зеленый(3) - мне и преподавателям
  </li>
  <li>
    желтый(4) - всем
  </li>
</ul>

<div class="create_folder_but" onclick="changeFolder(0)">
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
