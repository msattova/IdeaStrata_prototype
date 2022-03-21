    <h2>アイデアリスト</h2>
    <?php
    try {
      $dbh = open_db();
      $sql = 'SELECT * FROM ideas';
      $statement = $dbh->query($sql);
    ?>
      <div class="grid grid-cols-3 grid-rows-4">
        <?php while ($row = $statement->fetch()) : ?>
          <div class='element row-auto col-apna-1'>
            <p>
              <span class='idea'><?= str_replace("\n", "<br/>", $row['idea']) ?></span>
            </p>
            by <span class='user'><?= $row['user'] ?></span>
            <span class="datetime">at <?= $row['created_time'] ?></span>
            <div class="mt-2 w-full">
              <form action="src/edit.php" method="get" class="inline w-6/12">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="edit inline-block bg-green-500 w-5/12 text-yellow-50 font-semibold">編集</button>
              </form>
              <form action="src/delete.php" method="get" class="inline w-6/12">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="delete inline-block bg-pink-600 w-5/12 text-yellow-50 font-semibold">削除</button>
              </form>
            </div>
          </div>
        <?php endwhile; ?>
      <?php
    } catch (PDOException $e) {
      echo 'Error!' . ($e->getMessage());
      exit;
    }
      ?>
      </div>
