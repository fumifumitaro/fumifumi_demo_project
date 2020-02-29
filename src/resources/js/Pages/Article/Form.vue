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
                <mavon-editor
                        :language="'ja'"
                        v-model="content"
                        style="border: solid 0.2em #afeeee; margin: 2em 1.5em;"
                />
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
                content: ''
            }
        },
        methods: {
            submit: function () {
                axios.post(this.$route('article.store'), {
                    content: this.content
                })
                    .then(res => this.sentNotify())
                    .catch(err => this.errorNotify());
            },
            sentNotify: function () {
                this.$notify.success({
                    title: '保存しました',
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