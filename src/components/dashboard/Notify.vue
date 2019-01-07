<template>
  <div class="notify__wrapper ui-card ui-card--shadow">
    <h3 v-if="lang === 'ru'" class="ui-title-3">Уведомления</h3>
    <h3 v-else class="ui-title-3">Notifications</h3>
    <div class="notify__content" :class="{ loading: loading }">
      <p v-if="error.error">Error: {{ error.message }}</p>
      <div v-if="loading">Loading...</div>
      <messages v-else :messages="notify" :lang="lang"></messages>
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
      notify: null,
      loading: true,
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
        this.notify = response.data.notify
      })
      .catch(error => {
        this.error.error = true
        this.error.message = error
        console.log(error)
      })
      .finally(() => (this.loading = false))
  }
}
</script>
