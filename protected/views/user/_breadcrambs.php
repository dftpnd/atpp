<?php
end($breadcrambs);
$laste_id = key($breadcrambs);
?>

<?php if (empty($breadcrambs)): ?>
  <a href="/user/files?id=<?php echo $user->id; ?>" async="async" class="classic"><?php echo $user->prof->name . ' ' . $user->prof->surname ?></a>
  <span>/</span>
<?php else: ?>
  <a href="/user/files?id=<?php echo $user->id; ?>"  async="async" class="classic"><?php echo $user->prof->name . ' ' . $user->prof->surname ?></a>
  <span>/</span>
  <?php foreach ($breadcrambs as $id => $name) : ?>
    <?php if ($id == $laste_id): ?>
      <span><?php echo $name; ?></span>
    <?php else: ?>
      <span onclick="getOpenFolder(<?php echo $id; ?>)" class="classic"><?php echo $name; ?></span>
      <span>/</span>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>