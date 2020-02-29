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
    </layout>
</template>

<script>
    import Layout from '@/Pages/Base/Layout'

    export default {
        components: {
            Layout
        },
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
                axios.post(this.$route('register'), {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                    .then(res => this.sentNotify())
                    .catch(err => this.errorNotify());
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
