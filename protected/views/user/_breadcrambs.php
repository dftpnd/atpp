<?php if (empty($breadcrambs)): ?>
  <a href="/user/files?id=<?php echo $user->id; ?>" class="classic"><?php echo $user->prof->name . ' ' . $user->prof->surname ?></a>
  <span>/</span>
<?php else: ?>
  <a href="/user/files?id=<?php echo $user->id; ?>" class="classic"><?php echo $user->prof->name . ' ' . $user->prof->surname ?></a>
  <span>/</span>
  <?php foreach ($breadcrambs as $id => $name) : ?>
    <a href="/user/files?id=<?php echo $user->id; ?>&parent_id=<?php echo $id; ?>" class="classic"><?php echo $name; ?></a>
    <span>/</span>
  <?php endforeach; ?>
<?php endif; ?>