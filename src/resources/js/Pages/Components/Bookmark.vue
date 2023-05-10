<template>
    <button
        label="bookmark"
        :style="{ color: color_bm, border: 0, backgroundColor: 'white', width: 'max-content' }"
        @click="bookmark"
    >☆</button>
</template>

<script>
import Layout from '../Base/Layout.vue';
export default {
    components: {
        Layout,
    },
    data(){
        return{
            boolean_bm: false,
            color_bm: 'black',
        }
    },
    methods: {
        bookmark() {
            this.bookmark_bm = !this.bookmark_bm;
            if(this.bookmark_bm){
                this.color_bm = 'yellow'
            }else{
                this.color_bm = 'black'
            }
        },
    }
};
</script>