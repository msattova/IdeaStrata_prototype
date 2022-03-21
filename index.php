<?php
  session_start();
  $token = bin2hex(random_bytes(20));
  $_SESSION['token'] = $token;
  require_once $_SERVER['DOCUMENT_ROOT'] . '/idea_strata/vendor/autoload.php';
  require_once __DIR__ . '/src/functions.php';
  include_once __DIR__ . '/src/includes/header.php';
?>
<div class="m-3">
    <p>アイデアを蓄積・共有しましょう</p>
    <?php include_once __DIR__ . '/src/includes/resister_form.php';?>
    <?php include_once __DIR__ . '/src/includes/list.php';?>
</div>
<?php include_once __DIR__ . '/src/includes/footer.php' ?>
