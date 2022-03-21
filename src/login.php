<?php
include __DIR__.'/token_check.php';
require_once __DIR__ . '/functions.php';

if (empty($_POST['username']) | empty($_POST['password']) | empty($_POST['mailaddress'])) {
  echo 'エラーが発生しました';
  exit;
}
if ( !filter_var( $_POST['mailaddress'], FILTER_VALIDATE_EMAIL )){
  echo 'エラーが発生しました';
  exit;
}

try {
  $dbh = open_db();
  $sql = 'SELECT password FROM users WHERE name=:username AND mail_address=:mail_address';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
  $stmt->bindParam(':mail_address', $_POST['mailaddress'], PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$result) {
    echo 'Login Failed.';
    exit;
  }
  if (password_verify($_POST['password'], $result['password'])) {
    session_regenerate_id(true);
    $_SESSION['login'] = true;
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['user_id'] = $result['id'];
    header("Location: ../index.php");
  } else {
    echo 'Login Failed. Password invalid.';
    exit;
  }
} catch (PDOException $e) {
  echo ''.$e->getMessage();
  exit;
}
