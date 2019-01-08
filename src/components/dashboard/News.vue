<template>
  <div class="news__wrapper ui-card ui-card--shadow">
    <!-- //TODO fix all loading -->
    <!-- titles -->
    <h3 v-if="lang === 'ru'" class="ui-title-3">Новостная лента</h3>
    <h3 v-else class="ui-title-3">News Feed</h3>
    <!-- content -->
    <div class="notify__content" :class="{ loading: loading }">
      <!-- find error TODO: err->connection -->
      <p v-if="error.error">Error: {{ error.message }}</p>
      <!-- loading data TODO: rm use getter -->
      <div v-if="loading">Loading...</div>
      <!-- message table -->
      <messages
        v-else
        :lang="lang"
        :messages="messages"
        :messagesLength="messagesLength"
        :loading="loadingForBtn"
        @more="loadMore">
      </messages>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import messages from '../UI/Messages.vue'
export default {
  components: { messages },
  props: {
    lang: {
      type: String,
      default: 'en'
    }
  },
  data() {
    return {
      loading: true,
      loadingForBtn: false,
      error: {
        error: false,
        message: null
      }
    };
  },
  mounted() {
    axios
      .get('https://vedees.ru/wcms/api.php', {})
      .then(response => {
        // data
        let res = response.data.news,
            news = [],
            newsOld = [];

        // 2 arrays created
        for (let i = 0; i < res.length; i++) {
          if (res[i].main) news.push(res[i])
          else newsOld.push(res[i])
        }
        this.$store.dispatch('setNews', news)
        this.$store.dispatch('setNewsOld', newsOld)
        // Testing
        // console.log(this.$store.getters.news)
        // console.log(this.$store.getters.newsOldFilter)
      })
      .catch(error => {
        this.error.error = true
        this.error.message = error
        console.log(error)
      })
      .finally(() => (this.loading = false))
  },
  computed: {
    messages () {
      return this.$store.getters.newsMain
    },
    messagesLength () {
      return this.$store.getters.newsOldFilter.length
    }
  },
  methods: {
    loadMore () {
      this.loadingForBtn = true
      //TODO =)
      setTimeout(() => {
        this.loadingForBtn = false
        this.$store.dispatch('loadNews')
          .catch(err => {
            this.error.error = true
            this.error.message = error
          })
      }, 500)
    }
  }
}
</script>
