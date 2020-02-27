<template>
    <div>
        <header>
            <div class="items-right flex">
                <div class="header-links items-under" style="padding: 1em">
                    <a href="">Login</a>
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
                <el-button type="primary" plain round style="width: 30%; margin-left: auto; margin-right: 2em;">
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
        }
    }
</script>