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

try{
  $dbh = open_db();
  $sql = 'UPDATE ideas SET idea = :idea , created_time = NOW() WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $idea = $_POST['idea'];
  $id = (int) $_POST['id'];
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->bindParam(':idea', $idea, PDO::PARAM_STR);
  $stmt->execute();
  echo <<< _TEXT_
  <p>アイデアの更新に成功しました！</p>
  <p><a href='../index.php'>アイデアを確認する</a></p>
  _TEXT_;
}catch(PDOException $e){
  exit;
}
