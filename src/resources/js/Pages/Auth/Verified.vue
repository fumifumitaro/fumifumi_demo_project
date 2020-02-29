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
                    <h2>認証完了</h2>
                </div>
                <div class="sentence">
                    <p>メール認証が完了しました。</p>
                </div>
                <el-button
                        type="primary"
                        plain
                        round
                        style="margin: auto; width: 60%;"
                        @click="toTop"
                >
                    トップへ戻る
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created: function(){
            setTimeout(this.toTop, 2000)
        },
        methods: {
            toTop: function() {
                this.$inertia.visit('/')
            }
        }
    }
</script>
