<template>
    <div>
        <header>
            <div class="items-right flex">
                <div class="header-links items-under" style="padding: 1em">
                    <a href="/login">
                        Login
                    </a>
                    <a href="/logout">
                        Logout
                    </a>
                    <a href="/register">
                        Register
                    </a>
                </div>
            </div>
        </header>
        <div class="auth">
            <div class="contents-box">
                <div class="content-title">
                    <h2>会員登録</h2>
                </div>
                <table>
                    <tr>
                        <th>ユーザーネーム</th>
                        <td>
                            <i class="el-icon-user"></i>
                        </td>
                        <td>
                            <el-input placeholder="Please input" v-model="name"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>
                            <i class="el-icon-message"></i>
                        </td>
                        <td>
                            <el-input placeholder="Please input" v-model="email"></el-input>
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td>
                            <i class="el-icon-key"></i>
                        </td>
                        <td>
                            <el-input placeholder="Please input" v-model="password" show-password></el-input>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">パスワード(確認用)</th>
                        <td>
                            <el-input placeholder="Please input" v-model="password_confirmation"
                                      show-password></el-input>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        },

        methods: {
            submit: function () {
                axios.post('register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                    .then(res => this.sentNotify())
                    .catch(function (error) {
                        if (error.response) {
                            // The request was made and the server responded with a status code
                            // that falls out of the range of 2xx
                            console.log(error.response.data);
                            console.log(error.response.status);      // 例：400
                            console.log(error.response.statusText);  // Bad Request
                            console.log(error.response.headers);
                        } else if (error.request) {
                            // The request was made but no response was received
                            // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                            // http.ClientRequest in node.js
                            console.log(error.request);
                        } else {
                            // Something happened in setting up the request that triggered an Error
                            console.log('Error', error.message);
                        }
                        console.log(error.config);
                    });
            },
            sentNotify: function () {
                this.$notify.success({
                    title: 'メールを送信しました',
                    message: 'メールに貼られたリンクをクリックしてください',
                    offset: 150,
                    duration: 10000,
                    showClose: false,
                });
            },
            errorNotify: function () {
                this.$notify.error({
                    title: 'エラー',
                    message: '入力値に誤りがあります。',
                    offset: 150,
                    duration: 10000,
                    showClose: false,
                });
            }
        }
    }
</script>
