<?php
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token'] = $token;
require_once __DIR__ . '/functions.php';

if (empty($_GET['id'])) {
  echo 'エラーが発生しました';
  exit;
}
if (!is_id($_GET['id'])) {
  echo 'エラーが発生しました';
  exit;
}
$id = (int) $_GET['id'];

try {
  $dbh = open_db();
  $sql = 'SELECT id, idea, user, created_time FROM ideas WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = toHTML($result['id']);
  $user = toHTML($result['user']);
  $idea = toHTML($result['idea']);

  $html_form = <<<_HTML_
  <h2>削除確認</h2>
  <p>
    $idea
  </p>
  <p>
    本当に削除してよろしいですか？
  </p>
<form action="do_delete.php" method="post">
  <input type='hidden' name='id' value='$id'>
  <p class='button'>
    <input type="hidden" name="token" value="$token">
    <button type="submit">はい（削除する）</button>
  </p>
</form>
<form action="../index.php" method="post">
  <input type='hidden' name='id' value='$id'>
  <p class='button'>
    <button type="submit">いいえ（一覧に戻る）</button>
  </p>
</form>
_HTML_;
  include __DIR__ . '/includes/header.php';
  echo $html_form;
  include __DIR__ . '/includes/footer.php';
} catch (PDOException $e) {
  exit;
}
