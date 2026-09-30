<?php
require 'includes/config.php';
$title = 'Menu'; $page = 'menu.php';
$items = db()->query('SELECT * FROM menu_items ORDER BY category, name')->fetchAll();
$cats = array_unique(array_column($items, 'category'));
include 'includes/header.php';
?>
<section class="section">
  <h1>Our menu</h1>
  <div class="filters">
    <button class="filter active" data-cat="all">All</button>
    <?php foreach ($cats as $c): ?><button class="filter" data-cat="<?= e($c) ?>"><?= e($c) ?></button><?php endforeach; ?>
  </div>
  <div class="grid">
    <?php foreach ($items as $i): ?>
      <div class="card menu-item" data-cat="<?= e($i['category']) ?>">
        <div class="emoji"><?= e($i['emoji']) ?></div>
        <h3><?= e($i['name']) ?></h3>
        <p><?= e($i['description']) ?></p>
        <span class="price">₹<?= number_format($i['price'], 0) ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
