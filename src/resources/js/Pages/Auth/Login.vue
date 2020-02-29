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
                            <i class="el-icon-user"></i>
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
                </table>
                <el-button
                        type="primary"
                        plain
                        round
                        style="width: 30%; margin-left: auto; margin-right: 2em;"
                        @click="submit"
                >
                    ログイン
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
                email: '',
                password: ''
            }
        },
        methods: {
            submit: function () {
                this.$inertia.post(this.$route('login'), {
                    email: this.email,
                    password: this.password,
                })
            }
        }
    }
</script>