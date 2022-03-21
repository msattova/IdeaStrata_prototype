<h2 class="font-semibold text-lg">アイデアを登録</h2>
<div id="resistor" class="flex flex-row flex-auto">
  <?php if (!has_login()) : ?>
    <p>
      アイデアを登録するにはログインが必要です。
      <?php include_once __DIR__ . '/src/login_form.php'; ?>
    </p>
  <?php else : ?>
    <form action="src/add.php" method="post">
      <p>
        <label for="idea" class="block">アイデア（120字まで）</label>
        <textarea class="w-48" name="idea" placeholder="アイデアを入力..." v-model="input" ref="area" :style="styles">
            </textarea>
      </p>
      <p class='button'>
        <input type="hidden" name="token" value="<?= $token ?>">
        <button type="submit" class="inline-block bg-blue-500 w-5/12 text-yellow-50 font-semibold">登録</button>
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
