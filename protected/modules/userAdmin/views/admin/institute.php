<form action="/userAdmin/admin/institute" method="POST" class="create_institute">
    Создать институт
    <input type="text" name="institute" />
    <input type="submit" value="Сохранить" />
</form>

<?php foreach ($institutes as $value) : ?>
    <div class="view_institute">
        <div class="delete_institute" onclick="deleteInstitute($(this),<?php echo $value->id ?>)" >удалить институт</div>
        <h1><?php echo $value->name ?></h1>
        <form action="/userAdmin/admin/institute" method="POST" class="create_cafedra" >
            <input type="hidden" name="institute_id" value="<?php echo $value->id ?>" />
            <input type="text" name="cafedra_name" value="" />
            <input type="submit" value="Сохранить" />
        </form>
    </div>
<?php endforeach; ?>
