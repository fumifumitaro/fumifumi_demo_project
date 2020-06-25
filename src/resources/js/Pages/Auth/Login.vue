<template>
  <layout>
    <div class="auth">
      <div class="contents-box">
        <div class="content-title">
          <h2>ログイン</h2>
        </div>
        <table>
          <tr>
            <th>メールアドレス</th>
            <td>
              <i class="el-icon-user" />
            </td>
            <td>
              <el-input placeholder="Please input" v-model="email" />
              <a class="error_msg">{{ error.email }}</a>
            </td>
          </tr>
          <tr>
            <th>パスワード</th>
            <td>
              <i class="el-icon-key" />
            </td>
            <td>
              <el-input
                placeholder="Please input"
                v-model="password"
                show-password
              />
              <a class="error_msg">{{ error.password }}</a>
            </td>
          </tr>
        </table>
        <el-button
          type="primary"
          plain
          round
          style="width: 30% margin-left: auto; margin-right: 2em"
          @click="submit"
        >
          ログイン
        </el-button>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "@/Pages/Base/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      email: "",
      password: "",

      error: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    submit: function () {
      axios
        .post(this.$route("login"), {
          email: this.email,
          password: this.password,
        })
        .then(
          function (res) {
            this.error = {}; //TODO:一気に消すのはよくないかも
            this.sentNotify();
          }.bind(this)
        )
        .catch(
          function (res) {
            let err = res.response.data.errors;

            //TODO:あんまいい書き方じゃない気がする
            if (err.email) {
              this.error.email = err.email[0];
            } else {
              this.error.email = "";
            }
            if (err.password) {
              this.error.password = err.password[0];
            } else {
              this.error.password = "";
            }

            this.errorNotify();
          }.bind(this)
        );
    },
    sentNotify: function () {
      this.$notify.success({
        title: "ログインが完了しました！",
        message: "トップページに戻ります",
        offset: 150,
        duration: 10000,
        showClose: false,
      });
      setTimeout(this.toTop, 2000);
    },
    errorNotify: function () {
      this.$notify.error({
        title: "エラー",
        message: "入力値に誤りがあります。",
        offset: 150,
        duration: 10000,
        showClose: false,
      });
    },
    toTop: function () {
      this.$inertia.visit(this.$route("home"));
    },
  },
};
</script>
