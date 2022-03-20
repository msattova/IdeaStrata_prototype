  <?php
  session_start();
  $token = bin2hex(random_bytes(20));
  $_SESSION['token'] = $token;
  require_once $_SERVER['DOCUMENT_ROOT'] . '/idea_strata/vendor/autoload.php';
  require_once __DIR__ . '/src/functions.php';
  include_once __DIR__ . '/src/includes/header.php';
  if (has_login()) {
    echo '<a href="src/logout.php">ログアウト</a>';
  }
  try {
    $dbh = open_db();
    $sql = 'SELECT * FROM ideas';
    $statement = $dbh->query($sql);
  ?>
    <p>アイデアを蓄積しましょう</p>
    <h2>アイデアを登録</h2>
    <div id="resistor">
      <?php if (!has_login()) : ?>
        <p>
          アイデアを登録するにはログインが必要です。
          <?php include_once __DIR__ . '/src/login_form.php'; ?>
        </p>
      <?php else : ?>
        <form action="src/add.php" method="post">
          <p>
            <label for="idea">アイデア（120字まで）</label>
            <textarea name="idea" placeholder="アイデアを入力..." v-model="input" ref="area" :style="styles"></textarea>
          </p>
          <p class='button'>
            <input type="hidden" name="token" value="<?= $token ?>">
            <button type="submit">登録</button>
          </p>
        </form>
      <?php endif; ?>
    </div>
    <script>
      new Vue({
        el: "#resistor",
        data() {
          return {
            input: "",
            height: "2em",
          };
        },
        computed: {
          styles() {
            return {
              "height": this.height,
            }
          }
        },
        methods: {
          resize() {
            this.height = this.$refs.area.scrollHeight + 'px';
            this.height = "auto";
            this.$nextTick(() => {
              this.height = this.$refs.area.scrollHeight + 'px';
            })
          }
        },
        watch: {
          input() {
            this.resize();
          },
        },
        mounted() {
          this.resize();
        }
      })
    </script>
    <h2>アイデアリスト</h2>
    <div>
      <?php while ($row = $statement->fetch()) : ?>
        <div class='element'>
          <p>
            <span class='idea'><?= str_replace("\n", "<br/>", $row['idea']) ?></span>
          </p>
          by <span class='user'><?= $row['user'] ?></span>
          <span class="datetime">at <?= $row['created_time'] ?></span>
          <form action="src/edit.php" method="get">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" class="edit">編集</button>
          </form>
          <form action="src/delete.php" method="get">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" class="delete">削除</button>
          </form>
        </div>
      <?php endwhile; ?>
    <?php
  } catch (PDOException $e) {
    echo 'Error!' . ($e->getMessage());
    exit;
  }
    ?>
    </div>
    <?php include __DIR__ . '/src/includes/footer.php' ?>
