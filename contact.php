<?php
require 'includes/config.php';
$title = 'Contact'; $page = 'contact.php';
$errors = []; $old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_map('trim', $_POST);
    if (!csrf_ok()) $errors[] = 'Session expired. Please refresh and try again.';
    if (($old['name'] ?? '') === '') $errors[] = 'Please enter your name.';
    if (!filter_var($old['email'] ?? '', FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email.';
    if (($old['message'] ?? '') === '') $errors[] = 'Please write a message.';
    if (!$errors) {
        db()->prepare('INSERT INTO messages (name,email,message) VALUES (?,?,?)')
            ->execute([mb_substr($old['name'], 0, 100), mb_substr($old['email'], 0, 150), $old['message']]);
        flash('Message sent! We will get back to you soon.');
        header('Location: contact.php'); exit;
    }
}
include 'includes/header.php';
?>
<section class="section narrow">
  <h1>Contact us</h1>
  <p>📍 12 Coffee Street &nbsp;|&nbsp; 📞 +91 98765 43210 &nbsp;|&nbsp; ✉️ hello@brewandbite.com</p>
  <?php foreach ($errors as $er): ?><p class="err">• <?= e($er) ?></p><?php endforeach; ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <input name="name" placeholder="Your name" maxlength="100" value="<?= e($old['name'] ?? '') ?>" required>
    <input name="email" type="email" placeholder="Your email" maxlength="150" value="<?= e($old['email'] ?? '') ?>" required>
    <textarea name="message" rows="5" placeholder="Your message" required><?= e($old['message'] ?? '') ?></textarea>
    <button class="btn" type="submit">Send message</button>
  </form>
</section>
<?php include 'includes/footer.php'; ?>
