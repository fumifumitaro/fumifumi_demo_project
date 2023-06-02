<template>
    <div>
        <button
            label="bookmark"
            :style="{ color: color_bm, border: 0, backgroundColor: 'white', width: 'max-content' }"
            @click="bookmark_function(); submit()"
        >☆</button>
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
            UserBookmark: this.bookmark,
            color_bm: '',
        }
    },
    created() {
        console.log("created")
            if(this.UserBookmark == 1){
                this.color_bm = 'yellow';
            }else if(this.UserBookmark == 0){
                this.color_bm = 'black';
            }
    },
    methods: {
        bookmark_function() {
            if(this.UserBookmark == 0){
                this.UserBookmark = 1;
                this.color_bm = 'yellow';
            }else{
                this.UserBookmark = 0;
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
        bookmark: Number,
        article: Number,
    },
};
</script>