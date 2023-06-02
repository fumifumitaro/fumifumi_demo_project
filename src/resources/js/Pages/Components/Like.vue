<template>
    <div>
        <button
            label="like"
            :style="{ color: color, border: 0, backgroundColor: 'white', width: 'max-content' }"
            @click="like_function(); submit()"
        >♡</button>
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
            UserLike: this.like,
            color: '',
        }
    },
    created() {
        console.log("created")
            if(this.UserLike == 1){
                this.color = 'red';
            }else if(this.UserLike == 0){
                this.color = 'black';
            }
    },
    methods: {
        like_function() {
            if(this.UserLike == 0){
                this.UserLike = 1;
                this.color = 'red';
            }else{
                this.UserLike = 0;
                this.color = 'black';
            }
        },
        submit: function () {
            axios
            .post(this.$route("like"),{
                like: this.UserLike,
                article: this.article
            })
        },
    },
    props: {
        like: Number,
        article: Number,
    },
};
</script>