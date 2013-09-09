<div class="vk">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

    <h1>Создать / изменить вопрос</h1>

    <form id="create_forum" class="default_form">
        <label class="df_lvl_1">
            <div class="info_to_help">Заголовок</div>
            <input type="text" value="" name="Forum[title]"/>
        </label>
        <label class="df_lvl_1">
            <div class="info_to_help">Содержание</div>
            <input type="text" value="" name="Forum[content]" />
        </label>
        <label class="df_lvl_1">
            <div class="ui-widget">
                <label for="tags">Tags: </label>
                <input id="tags" name="Forum[tags]" />
            </div>
        </label>



        <input type="submit" value="Сохранить" onclick="updateForum(<?php echo $id ?>, $(this));return false"/>
    </form>
</div>