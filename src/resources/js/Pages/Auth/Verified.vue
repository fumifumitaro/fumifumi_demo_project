<template>
    <layout>
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
    </layout>
</template>

<script>
    import Layout from '@/Pages/Base/Layout'

    export default {
        components: {
            Layout
        },
        created: function () {
            setTimeout(this.toTop, 2000)
        },
        methods: {
            toTop: function () {
                this.$inertia.visit(this.$route('home'))
            }
        }
    }
</script>
