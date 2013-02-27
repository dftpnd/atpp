<div class="vk">
  <form id="po-podob">
    <input type="hidden" name="group_id" value="<?php echo $group_id ?>">
    <select name="group_podobiu">
      <?php foreach ($groups as $group): ?>
        <?php if ($group_id != $group->id): ?>
          <option value="<?php echo $group->id ?>" >
            <?php echo $group->name . " 1-" . $group->inseption->prefix_year; ?>
          </option>
        <?php endif; ?>
      <?php endforeach; ?>
    </select>
    <br />
    <br />
    <br />
    <div class="anchor"></div>
    <div class="submit_but" style="float: right" onclick="zapolnit($(this))">
      Сохранить
    </div>
    <div class="anchor"></div>
  </form>
</div>
<script>
  function zapolnit(el){
    loader.show();
    $.ajax({
      url:'/userAdmin/admin/Zapolnit',
      type: 'POST',
      dataType: 'json',
      data: $('#po-podob').serialize(),
      success: function(data){
        if(data.status == 'good')
          location.reload();
        else
          alert('Ошибка')
      }
    });
  }
</script>