<template>
  <div class="notify__wrapper ui-card ui-card--shadow">
    <!-- titles -->
    <div class="title__wrapper">
      <h3 v-if="lang === 'ru'" class="ui-title-3">Уведомления</h3>
      <h3 v-else class="ui-title-3">Notifications</h3>
      <svg @click="getNotifyLazy()" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" cursor="pointer" x="0px" y="0px" viewBox="0 0 489.935 489.935" style="enable-background:new 0 0 489.935 489.935;" xml:space="preserve"> <g> <path d="M278.235,33.267c-116.7,0-211.6,95-211.6,211.7v0.7l-41.9-63.1c-4.1-6.2-12.5-7.9-18.7-3.8c-6.2,4.1-7.9,12.5-3.8,18.7 l60.8,91.5c2.2,3.3,5.7,5.4,9.6,5.9c0.6,0.1,1.1,0.1,1.7,0.1c3.3,0,6.5-1.2,9-3.5l84.5-76.1c5.5-5,6-13.5,1-19.1 c-5-5.5-13.5-6-19.1-1l-56.1,50.7v-1c0-101.9,82.8-184.7,184.6-184.7s184.7,82.8,184.7,184.7s-82.8,184.7-184.6,184.7 c-49.3,0-95.7-19.2-130.5-54.1c-5.3-5.3-13.8-5.3-19.1,0c-5.3,5.3-5.3,13.8,0,19.1c40,40,93.1,62,149.6,62 c116.6,0,211.6-94.9,211.6-211.7S394.935,33.267,278.235,33.267z"></path> </g></svg>
    </div>
    <!-- content -->
    <div class="notify__content">
      <div v-if="loading" class="preloader__wraper">
        <Preloader :width="90" :height="90"></Preloader>
      </div>
      <!-- find error TODO: err->connection -->
      <p v-if="error.error">Error: {{ error.message }}</p>
      <!-- message table -->
      <messages
        v-if="!error.error && !loading"
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
import Preloader from '../UI/Preloader.vue'

export default {
  components: { messages, Preloader },
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
    this.getNotify()
  },
  computed: {
    messages () {
      return this.$store.getters.notifyMain
    },
    messagesLength () {
      return this.$store.getters.notifyOldFilter.length
    }
  },
  methods: {
    getNotify () {
      this.loading = true
      axios
        .get('https://vedees.ru/wcms/api.php', {})
        .then(response => {
        // data
        let res = response.data.notify,
            notify = [],
            notifyOld = [];

          // 2 arrays created
          for (let i = 0; i < res.length; i++) {
            if (res[i].main) notify.push(res[i])
            else notifyOld.push(res[i])
          }
          this.$store.dispatch('setNotify', notify)
          this.$store.dispatch('setNotifyOld', notifyOld)
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
    getNotifyLazy () {
      this.loading = true
      setTimeout(() => {
        this.getNotify()
      }, 800)
    },
    loadMore () {
      this.loadingForBtn = true
      //TODO =)
      setTimeout(() => {
        this.loadingForBtn = false
        this.$store.dispatch('loadNotify')
          .catch(err => {
            this.error.error = true
            this.error.message = error
          })
      }, 500)
    }
  }
}
</script>
