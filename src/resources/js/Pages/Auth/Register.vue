<template>
  <layout>
    <div class="auth">
      <div class="contents-box">
        <div class="content-title">
          <h2>会員登録</h2>
        </div>
        <table>
          <tr>
            <th>ユーザーネーム</th>
            <td>
              <i class="el-icon-user" />
            </td>
            <td>
              <el-input placeholder="Please input" v-model="name" />
              <a class="error_msg">{{ error.name }}</a>
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>
              <i class="el-icon-message" />
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
          <tr>
            <th colspan="2">パスワード(確認用)</th>
            <td>
              <el-input
                placeholder="Please input"
                v-model="password_confirmation"
                show-password
              />
            </td>
          </tr>
        </table>
        <el-button
          type="primary"
          plain
          round
          style="width: 30%; margin-left: auto; margin-right: 2em;"
          @click="submit"
        >
          登録する
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
      name: "",
      email: "",
      password: "",
      password_confirmation: "",

      error: {
        name: "",
        email: "",
        password: "",
      },
    };
  },

  methods: {
    submit: function () {
      axios
        .post(this.$route("register"), {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
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
            if (err.name) {
              this.error.name = err.name[0];
            } else {
              this.error.name = "";
            }
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
        title: "メールを送信しました",
        message: "メールに貼られたリンクをクリックしてください",
        offset: 150,
        duration: 10000,
        showClose: false,
      });
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
  },
};
</script>
