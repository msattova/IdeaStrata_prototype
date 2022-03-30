<?php
include __DIR__.'/token_check.php';
require_once __DIR__.'/functions.php';
include __DIR__.'/includes/header.php';

date_default_timezone_set("Asia/Tokyo");
$now = new DateTime();

if($_POST['idea'] === ''){
  echo 'エラー！　アイデアが空です。';
  exit;
}

try {
  $dbh = open_db();
  $sql = 'INSERT INTO ideas (id, idea, user, user_id, created_time, updated_time, good) VALUES(NULL, :idea, :user, :userid, NOW(), NOW(), 0)';
  $stmt = $dbh->prepare($sql);
  $idea = toHTML($_POST['idea']);
  $user = toHTML($_SESSION['username']);
  $user_id = $_SESSION['user_id'] ?? 0;
  $stmt->bindParam(":idea", $idea, PDO::PARAM_STR);
  $stmt->bindParam(":user", $user, PDO::PARAM_STR);
  $stmt->bindParam(":userid", $user_id, PDO::PARAM_INT);
  $stmt->execute();

  echo <<< _TEXT_
  <p>アイデアの登録に成功しました！</p>
  <p><a href='../index.php'>アイデアを確認する</a></p>
  _TEXT_;

} catch (PDOException $e) {
  print 'Error! ' . ($e->getMessage());
  exit;
}


include __DIR__ . '/includes/footer.php';
