<?php
require_once __DIR__ . '/functions.php';

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);


if (!isset($_SESSION)) {
  session_start();
}
if (empty($data['token'])) {
  echo json_encode('error');
  exit;
}
if (!(hash_equals($data['token'], $data['token']))) {
  echo json_encode("error");
  exit;
}

$idea_id = $data['id'] ?? false;
$good_num = $data['good']+1 ?? false;

if(!$idea_id && !$good_num){
  exit;
}

$dbh = open_db();
$sql = 'UPDATE ideas SET good=:good WHERE id=:id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $idea_id, PDO::PARAM_INT);
$stmt->bindParam(':good', $good_num, PDO::PARAM_INT);
$stmt->execute();

echo json_encode($good_num);

