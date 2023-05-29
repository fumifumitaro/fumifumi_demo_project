<template>
    <div>
        <button
            label="bookmark"
            :style="{ color: color_bm, border: 0, backgroundColor: 'white', width: 'max-content' }"
            @click="bookmark_function(); submit()"
        >☆</button>
        <p>{{ this.bookmark }}</p>
        <p>{{ this.article }}</p>
    </div>
</template>

<script>
import Layout from '../Base/Layout.vue';
export default {
    components: {
        Layout,
    },
    data(){
        return{
            UserBookmark: this.user_bookmark,
            color_bm: 'black',
        }
    },
    methods: {
        bookmark_function() {
            this.UserBookmark = !this.UserBookmark;
            if(this.UserBookmark){
                this.color_bm = 'yellow';
            }else{
                this.color_bm = 'black';
            }
        },
        submit: function () {
            axios
            .post(this.$route("bookmark"),{
                bookmark: this.UserBookmark,
                article: this.article
            })
        },
    },
    props: {
        bookmark: Boolean,
        article: Number,
    },
};
</script>