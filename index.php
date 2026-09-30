<?php
require 'includes/config.php';
$title = 'Home'; $page = 'index.php';
$featured = db()->query('SELECT * FROM menu_items WHERE featured = 1 LIMIT 3')->fetchAll();
include 'includes/header.php';
?>
<section class="hero">
  <h1>Coffee brewed with love, food made fresh</h1>
  <p>A cozy corner for great coffee, fresh bakes and good conversations.</p>
  <a class="btn" href="reservation.php">Book a table</a>
  <a class="btn ghost" href="menu.php">View menu</a>
</section>

<section class="section">
  <h2>Customer favourites</h2>
  <div class="grid">
    <?php foreach ($featured as $i): ?>
      <div class="card">
        <div class="emoji"><?= e($i['emoji']) ?></div>
        <h3><?= e($i['name']) ?></h3>
        <p><?= e($i['description']) ?></p>
        <span class="price">₹<?= number_format($i['price'], 0) ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="section alt">
  <h2>Why people love us</h2>
  <div class="grid">
    <div class="card"><h3>🌱 Fresh ingredients</h3><p>Baked and brewed daily, never stored for days.</p></div>
    <div class="card"><h3>🛋️ Cozy space</h3><p>Comfortable seating, soft music and free Wi-Fi.</p></div>
    <div class="card"><h3>⚡ Friendly service</h3><p>Fast, warm and always with a smile.</p></div>
  </div>
</section>

<section class="section">
  <h2>What guests say</h2>
  <div class="grid">
    <blockquote class="card">“Best cappuccino in town and the brownie is unreal.”<br><b>— Aarav</b></blockquote>
    <blockquote class="card">“Perfect place to work for a few hours. Lovely staff.”<br><b>— Meera</b></blockquote>
    <blockquote class="card">“Booked online in one minute. Great birthday dinner!”<br><b>— Rohan</b></blockquote>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
