<template>
    <div>
        <button
            label="bookmark"
            :style="{ color: color, border: 0, backgroundColor: 'white', width: 'max-content' }"
            @click="bookmark_function(); submit()"
        >☆</button>
        <p>{{ this.bookmark }}</p>
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
            UserBookmark: this.bookmark.bookmark,
            color: '',
        }
    },
    created() {
            if(this.UserBookmark == 1){
                this.color = 'yellow';
            }else if(this.UserBookmark == 0 || this.Userbookmark == null){
                this.color = 'black';
            }
    },
    methods: {
        bookmark_function() {
            if(this.UserBookmark == 0 || this.Userbookmark == null){
                this.UserBookmark = 1;
                this.color = 'yellow';
            }else{
                this.UserBookmark = 0;
                this.color = 'black';
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
        bookmark: {
            type: Array,
            required: false,
            default: [],
        },
        article: Number,
    },
};
</script>