<template>
  <layout>
    <div class="content">
      <div class="contents-box">
        <div class="contents-header">
          <div class="content-title">
            <h2>記事作成</h2>
          </div>
          <el-button
            type="primary"
            plain
            round
            style="margin-left: auto; margin-right: 2em;"
            @click="submit"
          >
            投稿する
          </el-button>
        </div>
        <form>
          <table>
            <tr>
              <th>タイトル</th>
              <td>
                <i class="el-icon-postcard"></i>
              </td>
              <td>
                <el-input
                  placeholder="Please input"
                  v-model="form.title"
                  style="width: 25em;"
                ></el-input>
                <a class="error_msg">{{ error.title }}</a>
              </td>
            </tr>
          </table>
          <div class="flex flex-column">
            <a class="error-content">{{ error.content }}</a>
            <mavon-editor
              :language="'ja'"
              v-model="form.content"
              style="border: solid 0.2em #afeeee; margin: 1.2em 1.5em;"
            />
          </div>
        </form>
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
      form: {
        title: "",
        content: "",
      },

      error: {
        title: "",
        content: "",
      },
    };
  },
  methods: {
    submit: function () {
      axios
        .post(this.$route("article.store"), this.form)
        .then((res) => this.sentNotify())
        .catch(
          function (res) {
            let err = res.response.data.errors;

            //TODO:あんまいい書き方じゃない気がする
            if (err.title) {
              this.error.title = err.title[0];
            } else {
              this.error.title = "";
            }
            if (err.content) {
              this.error.content = err.content[0];
            } else {
              this.error.content = "";
            }

            this.errorNotify();
          }.bind(this)
        );
    },
    sentNotify: function () {
      this.$notify.success({
        title: "保存しました",
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
