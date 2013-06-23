<div id="breadcrambs">
  <?php echo $html_breadcrambs; ?>
</div>

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

<div class="create_folder_but" onclick="changeFolder(0, event)">
    Создать папку
</div>
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
    <div class="tr_t tr_files">
        <div class="td_t files_folder">
            <div></div>
            <span>kfkfkf</span>
        </div>
        <div class="td_t">
            папка
        </div>
        <div class="td_t">
            --
        </div>
        <div class="td_t">
            только мне
        </div>
    </div>
    <div class="tr_t tr_files">
        <div class="td_t files_folder">
            <div></div>
            <span>2</span>
        </div>
        <div class="td_t">
            папка
        </div>
        <div class="td_t">
            --
        </div>
        <div class="td_t">
            только мне
        </div>
    </div>
    <div class="tr_t tr_files">
        <div class="td_t files_folder">
            <div></div>
            <span>3</span>
        </div>
        <div class="td_t">
            папка
        </div>
        <div class="td_t">
            --
        </div>
        <div class="td_t">
            только мне
        </div>
    </div>
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
