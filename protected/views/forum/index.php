<?php if (!Yii::app()->user->isGuest): ?>
    <div class="create_forum" onclick="openUpdateForum(0)"><input type="submit" value="Задать вопрос"/></div>
<?php endif; ?>

<a href="/" async="async" onclick="return false" >Click</a>
<div class="anchor"></div>
<div class="forum_area">
    <div class="forum_tag"></div>
    <div class="forum_content"></div>
</div>
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