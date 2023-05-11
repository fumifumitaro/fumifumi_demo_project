<template>
    <button
        label="favorite"
        :style="{ color: color_fv, border: 0, backgroundColor: 'white', width: 'max-content' }"
        @click="favorite"
    >♡
    </button>
</template>

<script>
import Layout from '../Base/Layout.vue';
export default {
    components: {
        Layout,
    },
    data(){
        return{
            boolean_fv: false,
            color_fv: 'black',
        }
    },
    methods: {
        favorite() {
            this.bookmark_fv = !this.bookmark_fv;
            if(this.bookmark_fv){
                this.color_fv = 'red'
            }else{
                this.color_fv = 'black'
            }
        }
    }
};
</script>