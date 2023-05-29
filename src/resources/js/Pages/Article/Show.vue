<template>
  <layout>
    <div class="content">
      <div class="contents-box">
        <div class="contents-header">
          <div class="content-title">
            <h2>{{ article.title }}</h2>
          </div>
        </div>
        <div :style="{ display: 'flex'}">
          <div class="article-content" v-html="article.content" />
          <Bookmark bookmark="user_bookmark" :article="article.id"/>
          <Favorite />
        </div>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "@/Pages/Base/Layout";
import Bookmark from "@/Pages/Components/Bookmark.vue";
import Favorite from "@/Pages/Components/Favorite.vue";

export default {
  data(){
    return{
      user_bookmark: this.bookmark,
    }
  },
  components: {
    Layout,
    Bookmark,
    Favorite,
  },
  props: {
    article: {
      type: Object,
      required: true,
      default: null,
    },
    bookmark: {
      type: Boolean,
    }
  },
};
</script>
