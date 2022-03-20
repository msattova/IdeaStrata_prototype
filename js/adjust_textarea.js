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
