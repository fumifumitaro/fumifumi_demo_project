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
          <Bookmark bookmark="user_bookmark" :article="article.id" :bookmark="article.bookmark" v-show="isVisible"/>
          <Like like="user_like" :article="article.id" :like="article.like" v-show="isVisible"/>
        </div>
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "@/Pages/Base/Layout";
import Bookmark from "@/Pages/Components/Bookmark.vue";
import Like from "@/Pages/Components/Like.vue";

export default {
  components: {
    Layout,
    Bookmark,
    Like,
  },
  props: {
    article: {
      type: Object,
      required: true,
      default: null,
    },
  },
  data() {
    return {
      isVisible: true,
    };
  },
  created() {
    if(this.article.user_id == null || this.article.user_id == ''){
        this.isVisible = false;
    } else {
        this.isVisible = true;
    }
  },
};
</script>
