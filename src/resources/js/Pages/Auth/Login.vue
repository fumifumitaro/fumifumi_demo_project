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
                    <h2>ログイン</h2>
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
                        <th>パスワード</th>
                        <td>
                            <i class="el-icon-key"></i>
                        </td>
                        <td>
                            <el-input placeholder="Please input" v-model="password" show-password></el-input>
                        </td>
                    </tr>
                </table>
                <el-button type="primary" plain round style="width: 30%; margin-left: auto; margin-right: 2em;">
                    ログイン
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
                password: ''
            }
        }
    }
</script>