<template>
  <layout>
    <div class="content">
      <div class="contents-box">
        <div class="contents-header">
          <div class="content-title">
            <h2>記事一覧</h2>
          </div>
          <el-button
            type="primary"
            plain
            round
            style="margin-left: auto; margin-right: 2em;"
            @click="goToForm"
          >
            記事を書く
          </el-button>
        </div>
        <el-table
          :data="tableData"
          style="width: 100%; padding: 1.5em; z-index: 1;"
          @row-click="goToArticle"

        >
          <el-table-column prop="username" label="Author" width="180" />
          <el-table-column prop="title" label="Title" />
          <el-table-column prop="date" label="Date" width="180" />
          <el-table-column label="Bookmark">
            <template slot-scope="scope">
              <Bookmark  @click.native.stop :article="scope.row.id" :bookmark="scope.row.bookmark" />
            </template>
          </el-table-column>
          <el-table-column label="Like">
            <template slot-scope="scope">
              <Like  @click.native.stop :article="scope.row.id" :like="scope.row.like" />
            </template>
          </el-table-column>
        </el-table>
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
    articles: {
      type: Array,
      required: false,
      default: [],
    },
  },
  data() {
    return {
      tableData: this.articles,
    };
  },
  methods: {
    goToForm: function () {
      this.$inertia.visit(this.$route("article.create"));
    },
    goToArticle(article) {
      this.$inertia.visit(this.$route("article.show", article.id));
    },
  },
};
</script>