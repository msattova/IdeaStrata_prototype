<?php
include __DIR__.'/token_check.php';
require_once __DIR__ . '/functions.php';
include __DIR__ . '/includes/header.php';

if (empty($_POST['id'])) {
  exit;
}
if (!is_id($_POST['id'])) {
  exit;
}

if (empty($_POST['idea'])) {
  exit;
}
if (empty($_POST['user'])) {
  exit;
}

try {
  $dbh = open_db();
  $sql = 'DELETE FROM ideas WHERE id=:id';
  $stmt = $dbh->prepare($sql);
  $id = (int) $_POST['id'];
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  echo <<< _TEXT_
  <p>アイデアの削除に成功しました！</p>
  <p><a href='../index.php'>一覧に戻る</a></p>
  _TEXT_;
} catch (PDOException $e) {
  exit;
}
