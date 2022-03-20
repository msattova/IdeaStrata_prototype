<?php
session_start();
$token = bin2hex(random_bytes(20));
$_SESSION['token'] = $token;

require_once __DIR__ . '/functions.php';

if(empty($_GET['id'])){
  echo 'idが空';
  exit;
}
if(!is_id($_GET['id'])){
  echo 'idが不正';
  echo var_dump($_GET['id']);
  exit;
}
$id = (int) $_GET['id'];

try{
  $dbh = open_db();
  $sql = 'SELECT id, idea, user, created_time FROM ideas WHERE id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $id = toHTML($result['id']);
  $user = toHTML($result['user']);
  $idea = toHTML($result['idea']);

  $html_form = <<<_HTML_
<div id="edit">
<form action="update.php" method="post">
      <input type='hidden' name='id' value='$id'>
      <p>
        <label for="user">名前（30字まで）</label>
        <input type="text" name="user" value='$user'>
      </p>
      <p>
        <label for="idea">アイデア（120字まで）</label>
        <textarea name="idea" placeholder="アイデアを入力..." v-model="input" ref="area" :style="styles">$idea</textarea>
      </p>
      <p class='button'>
        <input type="hidden" name="token" value="$token">
        <button type="submit">更新</button>
      </p>
</form>
<script>
      new Vue({
        el: "#edit",
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
</div>
_HTML_;
  include __DIR__ . '/includes/header.php';
  echo $html_form;
  include __DIR__ . '/includes/footer.php';
} catch(PDOException $e) {
  exit;
}
