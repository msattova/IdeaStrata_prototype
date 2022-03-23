<div class="p-8 w-6/12">
  <form class="flex flex-col w-full" action=" src/login.php" method="post">
    <p class="flex flex-row flex-nowrap mt-2 mb-2 w-full">
      <label class="w-4/12" for="username">ユーザ名：</label>
      <input class="w-6/12 border rounded-lg" type="text" name="username" required>
    </p>
    <p class="flex flex-row flex-nowrap mt-2 mb-2 w-full">
      <label class="w-4/12" for="mailaddress">メールアドレス：</label>
      <input class="w-6/12 border rounded-lg" type="text" name="mailaddress" placeholder="email@example.com" required>
    </p>
    <p class="flex flex-row flex-nowrap mt-2 mb-2 w-full">
      <label class="w-4/12" for="password">パスワード：</label>
      <input class="w-6/12 text-sm border rounded-lg" type="password" name="password" required>
    </p>
    <p class="flex flex-row-reverse">
      <input type="hidden" name="token" value="<?= $token ?>">
      <button type="submit">ログイン</button>
    </p>
  </form>

</div>
