<?php require_once __DIR__ . '/../functions.php'; ?>
<h2 class="font-semibold text-lg">アイデアを登録</h2>
<?php if (!has_login()) : ?>
  <p>
    アイデアを登録するにはログインが必要です。
    <?php include_once __DIR__ . '/login_form.php'; ?>
  </p>
<?php else : ?>
  <div id="resister" class="flex flex-row flex-auto">
    <form action="src/add.php" method="post" class="w-10/12 flex flex-row flex-auto">
      <p class="inline-block w-8/12">
        <label for="idea" class="block">アイデア（120字まで）</label>
        <textarea class="w-full" name="idea" placeholder="アイデアを入力..." v-model="input" ref="area" :style="styles">
            </textarea>
      </p>
      <p class="button inline-block w-4/12 flex flex-col-reverse">
        <input type="hidden" name="token" value="<?= $token ?>">
        <button type="submit" class="bg-blue-500 w-full text-yellow-50 font-semibold">登録</button>
      </p>
    </form>
  </div>
  <script>
    new Vue({
      el: "#resister",
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
<?php endif; ?>
