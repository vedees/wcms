<template>
  <div class="notify__wrapper ui-card ui-card--shadow">
    <h3 class="ui-title-3">Notifications</h3>
    <div class="notify__content" :class="{ loading: loading }">
      <p v-if="error.error">Error: {{ error.message }}</p>
      <div v-if="loading">Loading...</div>
      <messages v-else :messages="notify"></messages>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import messages from '../UI/Messages.vue'
export default {
  components: { messages },
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
  filters: {
    currencydecimal(value) {
      return value.toFixed(2);
    }
  },
  mounted() {
    axios
      .get('https://vedees.ru/wcms/api/notify.php', {})
      .then(response => {
        this.notify = response.data.notify
      })
      .catch(error => {
        this.errored = true
        this.error.message = error
        console.log(error)
      })
      .finally(() => (this.loading = false))
  }
}
</script>
