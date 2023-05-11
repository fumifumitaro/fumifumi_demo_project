  <template>
    <layout>
      <div class="auth">
        <div class="contents-box">
          <div class="content-title">
            <h2>ユーザー情報</h2>
          </div>
          <table>
            <tr>
              <th>ユーザーネーム</th>
              <td>
                <i class="el-icon-user" />
              </td>
              <td>
                <th>{{ name }}</th>
                <a class="error_msg">{{ error.name }}</a>
              </td>
            </tr>
            <tr>
              <th>住所</th>
              <td>
                <i class="el-icon-house" />
              </td>
              <td>
                <th>{{ address }}</th>
                <a class="error_msg">{{ error.address }}</a>
              </td>
            </tr>
          </table>
          <el-button
            type="primary"
            plain
            round
            style="width: 30%; margin-left: auto; margin-right: 2em;"
            @click="editPage"
          >
            編集する
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
      editPage: function() {
        window.location.href = this.$route("my_page.user.edit");
      },
      sentNotify: function () {
          this.$notify.success({
              title: "更新しました！",
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
  