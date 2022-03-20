  <form action="src/login.php" method="post">
    <p>
      <label for="username">ユーザ名：</label>
      <input type="text" name="username">
    </p>
    <p>
      <label for="mailaddress">メールアドレス：</label>
      <input type="text" name="mailaddress">
    </p>
    <p>
      <label for="password">パスワード：</label>
      <input type="password" name="password" required>
    </p>
    <input type="hidden" name="token" value="<?= $token ?>">
    <button type="submit">ログイン</button>
  </form>
