<?php
include __DIR__.'/token_check.php';
require_once __DIR__.'/functions.php';
include __DIR__.'/includes/header.php';

date_default_timezone_set("Asia/Tokyo");
$now = new DateTime();
print $now->format('Y/m/d, G:i:s');

try {
  $dbh = open_db();
  $sql = 'INSERT INTO ideas (id, idea, user, created_time) VALUES(NULL, :idea, :user, NOW())';
  $stmt = $dbh->prepare($sql);
  $idea = toHTML($_POST['idea']);
  $user = toHTML(!has_login() ? $_POST['user'] : $_SESSION['username']);
  $stmt->bindParam(":idea", $idea, PDO::PARAM_STR);
  $stmt->bindParam(":user", $user, PDO::PARAM_STR);
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
