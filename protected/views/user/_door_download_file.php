<div class="vk">
  <h1>Загрузить в папку «<?php echo $folder->name; ?>»</h1>
  <div class="">За один раз можно выбрать несколько файлов.</div>
  <div class="uploded_file">
    <div class="">
      <div id="download_file">		
        <noscript>			
        <p>Включите JavaScript чтобы испльзовать file uploader.</p>
        </noscript>         
      </div>
    </div>
  </div>


  <script>
    var uploader = new qq.FileUploader({
      element: document.getElementById('download_file'),
      multiple: true,
      action: '/user/DownloadFile?user_id=<?php echo $user->id; ?>&parent_id=<?php echo $folder->parent_id ?>',
      debug: false, 
      onSubmit: function(id, fileName){
        goSpiner();
      },
      onComplete: function(id, fileName, responseText)
      {   
        alert('onComplete');
      }
    });           
  </script>
</div>