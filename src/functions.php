<?php

function toHTML(string $string): string{
  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function open_db() {
  require_once $_SERVER['DOCUMENT_ROOT'] . '/idea_strata/vendor/autoload.php';
  Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/idea_strata')->load();
  $user = $_ENV['USER'];
  $password = $_ENV['PASSWORD'];
  $opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false
  ];
  $dbh = new PDO('mysql:host=localhost;dbname=idea_stock_db', $user, $password, $opt);
  return $dbh;
}

function is_id(string $candidate): int|false {
  return preg_match('/\A\d{1,11}\z/', $candidate);
}

function has_login(): bool {
  return (isset($_SESSION) && array_key_exists('login', $_SESSION));
}

function has_good(): bool {
  //TODO: ログインしてる場合はそのユーザが👍を押したか判定
  return false;
}
