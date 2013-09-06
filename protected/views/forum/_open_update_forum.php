<div class="vk">
    <h1>Создать / изменить вопрос</h1>

    <form class="default_form">
        <label class="df_lvl_1">
            <div class="info_to_help">Заголовок</div>
            <input type="text" value=""/>
        </label>
        <label class="df_lvl_1">
            <div class="info_to_help">Содержание</div>
            <input type="text" value=""/>
        </label>
        <label class="df_lvl_1">
            <div id="tags" class="info_to_help">Тэг</div>
            <input type="text" value=""/>
        </label>
        <script>
            var availableTags = [
                "ActionScript",
                "AppleScript",
                "Asp",
                "BASIC",
                "C",
                "C++",
                "Clojure",
                "COBOL",
                "ColdFusion",
                "Erlang",
                "Fortran",
                "Groovy",
                "Haskell",
                "Java",
                "JavaScript",
                "Lisp",
                "Perl",
                "PHP",
                "Python",
                "Ruby",
                "Scala",
                "Scheme"
            ];
            $("#tags").autocomplete({
                source: availableTags
            });
        </script>


        <input type="submit" value="Сохранить" onclick="updateForum(<?php echo $id ?>);return false"/>
    </form>
</div>