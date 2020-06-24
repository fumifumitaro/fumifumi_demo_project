<template>
  <layout>
    <div class="content">
      <div class="contents-box">
        <div class="contents-header">
          <div class="content-title">
            <h2>{{ article.title }}</h2>
          </div>
        </div>
        <div class="article-content" v-html="article.content" />
      </div>
    </div>
  </layout>
</template>

<script>
import Layout from "@/Pages/Base/Layout";
export default {
  components: {
    Layout,
  },
  props: {
    article: {
      type: Object,
      required: true,
      default: null,
    },
  },
};
</script>
