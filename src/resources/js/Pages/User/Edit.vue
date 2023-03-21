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
            <th>住所</th>
            <td>
              <i class="el-icon-house" />
            </td>
            <td>
              <el-input placeholder="Please input" v-model="address" />
              <a class="error_msg">{{ error.address }}</a>
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
          更新する
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

　props: {
    user: {
      type: Object,
      required: true
    }
 },

  data() {
    return {
      name: this.user.name,
      address: this.user.address,

      error: {
        name: "",
        address: ""
      },
    };
  },

  methods: {
    submit: function () {
        console.log('aiueo')
      axios
        .post(this.$route("my_page.user.update"), {
          name: this.name,
          email: this.address
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
            if (err.address) {
              this.error.address = err.address[0];
            } else {
              this.error.address = "";
            }

            this.errorNotify();
          }.bind(this)
        );
    },
    sentNotify: function () {
        this.$notify.success({
            title: "更新しました！",
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
