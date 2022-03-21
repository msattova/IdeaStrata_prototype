<div class="p-8 w-4/12">
  <form class="flex flex-col" action=" src/login.php" method="post">
  <p class="flex flex-row flex-nowrap mt-2 mb-2">
    <label for="username">ユーザ名：</label>
    <input type="text" name="username" required>
  </p>
  <p class="flex flex-row flex-nowrap mt-2 mb-2">
    <label for="mailaddress">メールアドレス：</label>
    <input type="text" name="mailaddress" required>
  </p>
  <p class="flex flex-row flex-nowrap mt-2 mb-2">
    <label for="password">パスワード：</label>
    <input class="text-sm" type="password" name="password" required>
  </p>
  <p class="flex flex-row-reverse">
    <input type="hidden" name="token" value="<?= $token ?>">
    <button type="submit">ログイン</button>
  </p>
  </form>
</div>
