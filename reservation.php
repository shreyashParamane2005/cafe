<?php
require 'includes/config.php';
$title = 'Reserve a table'; $page = 'reservation.php';
$errors = []; $old = [];
$times = [];
for ($m = 9 * 60; $m <= 21 * 60; $m += 30) $times[] = sprintf('%02d:%02d', intdiv($m, 60), $m % 60);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old = array_map('trim', $_POST);
    if (!csrf_ok()) $errors[] = 'Session expired. Please refresh and try again.';
    $name = $old['name'] ?? ''; $email = $old['email'] ?? ''; $phone = $old['phone'] ?? '';
    $date = $old['date'] ?? ''; $time = $old['time'] ?? ''; $guests = (int)($old['guests'] ?? 0);
    $note = $old['note'] ?? '';

    if ($name === '') $errors[] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email.';
    if (!preg_match('/^[0-9+\- ]{7,15}$/', $phone)) $errors[] = 'Please enter a valid phone number.';
    $d = DateTime::createFromFormat('Y-m-d', $date);
    if (!$d || $d->format('Y-m-d') !== $date || $date < date('Y-m-d')) $errors[] = 'Please choose a valid date (today or later).';
    if (!in_array($time, $times, true)) $errors[] = 'Please choose a time slot.';
    if ($guests < 1 || $guests > 12) $errors[] = 'Guests must be between 1 and 12.';

    if (!$errors) {
        db()->prepare('INSERT INTO reservations (name,email,phone,res_date,res_time,guests,note) VALUES (?,?,?,?,?,?,?)')
            ->execute([mb_substr($name, 0, 100), mb_substr($email, 0, 150), $phone, $date, $time, $guests, mb_substr($note, 0, 255)]);
        flash('Thank you, ' . $name . '! Your table request is received. We will confirm shortly.');
        header('Location: reservation.php'); exit;
    }
}
include 'includes/header.php';
?>
<section class="section narrow">
  <h1>Reserve a table</h1>
  <?php foreach ($errors as $er): ?><p class="err">• <?= e($er) ?></p><?php endforeach; ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <input name="name" placeholder="Your name" maxlength="100" value="<?= e($old['name'] ?? '') ?>" required>
    <input name="email" type="email" placeholder="Email" maxlength="150" value="<?= e($old['email'] ?? '') ?>" required>
    <input name="phone" placeholder="Phone number" maxlength="15" value="<?= e($old['phone'] ?? '') ?>" required>
    <div class="row">
      <input name="date" type="date" min="<?= date('Y-m-d') ?>" value="<?= e($old['date'] ?? '') ?>" required>
      <select name="time" required>
        <option value="">Time</option>
        <?php foreach ($times as $t): ?><option <?= ($old['time'] ?? '') === $t ? 'selected' : '' ?>><?= $t ?></option><?php endforeach; ?>
      </select>
      <input name="guests" type="number" min="1" max="12" placeholder="Guests" value="<?= e($old['guests'] ?? '') ?>" required>
    </div>
    <textarea name="note" rows="3" maxlength="255" placeholder="Special request (optional)"><?= e($old['note'] ?? '') ?></textarea>
    <button class="btn" type="submit">Book table</button>
  </form>
</section>
<?php include 'includes/footer.php'; ?>
