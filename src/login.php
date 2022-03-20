<?php
include __DIR__.'/token_check.php';
require_once __DIR__ . '/functions.php';

if (empty($_POST['username']) | empty($_POST['password']) | empty($_POST['mailaddress'])) {
  exit;
}

try {
  $dbh = open_db();
  $sql = 'SELECT password FROM users WHERE name = :name AND mail_address=:mail_address';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':name', $_POST['username'], PDO::PARAM_STR);
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
    header("Location: ../index.php");
  } else {
    echo 'Login Failed. Password invalid.';
    exit;
  }
} catch (PDOException $e) {
  exit;
}
