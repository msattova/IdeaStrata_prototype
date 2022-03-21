    <h2 class="font-semibold text-lg">アイデアリスト</h2>
    <?php
    try {
      $dbh = open_db();
      $sql = 'SELECT * FROM ideas ORDER BY created_time';
      $statement = $dbh->query($sql);
    ?>
      <div id="list" class="grid grid-cols-3 grid-rows-4">
        <?php while ($row = $statement->fetch()) : ?>
          <div id="idea_of_<?= $row['id'] ?>" class='element row-auto col-apna-1'>
            <p>
              <span class='idea'><?= str_replace("\n", "<br/>", toHTML($row['idea'])) ?></span>
            </p>
            by <span class='user'><?= $row['user'] ?></span>
            <span class="datetime">at <?= $row['created_time'] ?></span>
            <div class="mt-2 w-full">
              <form action="src/edit.php" method="get" class="inline w-6/12">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <button type="submit" class="edit inline-block bg-green-500 w-4/12 text-yellow-50 font-semibold">編集</button>
              </form>
              <form action="src/delete.php" method="get" class="inline w-6/12">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="token" value="<?= $token ?>">
                <button type="submit" class="delete inline-block bg-pink-600 w-4/12 text-yellow-50 font-semibold">削除</button>
              </form>
              <button v-on:click="pressGood(<?= $row['id'] ?>, '<?= $token ?>')" type="button" class="inline-block text-lg">
                👍
              </button>
              <span>
                {{good_num}}
              </span>
            </div>
          </div>
          <script>
            new Vue({
              el: '#idea_of_<?= $row['id'] ?>',
              data: {
                good_num: <?= $row['good'] ?>,
              },
              methods: {
                pressGood: function(idIdea, token) {
                  const param = {
                    id: idIdea,
                    good: this.good_num,
                    token: token
                  };
                  fetch('src/good.php', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json'
                      },
                      body: JSON.stringify(param)
                    })
                    .then(response => response.json())
                    .then(res => {
                      this.good_num = res;
                    });
                }
              }
            });
          </script>
        <?php endwhile; ?>
      <?php
    } catch (PDOException $e) {
      echo 'Error!' . ($e->getMessage());
      exit;
    }
      ?>
      </div>
