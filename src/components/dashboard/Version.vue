<template>
  <div class="version__wrapper ui-card ui-card--shadow">
    <h3 class="ui-title-3">Info</h3>
    <div class="version__content" :class="{ loading: loading }">
      <p v-if="error.error">Error: {{ error.message }}</p>
      <div v-if="loading">Loading...</div>
      <p v-else class="ui-text-regular"> WCMS verison - {{ verCur }}</p>

      <!-- Need update -->
      <Alert v-if="!update.needUpdate && update.showMessage === true" @close="update.showMessage = !update.showMessage">
        <span slot="title" class="alert-title">{{ update.message  }}</span>
      </Alert>

      <!-- Don`t need that -->
      <!-- TODO use danger class -->
      <Alert v-if="update.needUpdate && update.showMessage === true" @close="update.showMessage = !update.showMessage">
        <span slot="title" class="alert-title">{{ update.message  }}</span>
      </Alert>

      <!-- Update button -->
      <div class="button-list button-list--center" v-if="update.needUpdate" >
        <a href="https://wcms.space/download" class="button button--round button-primary icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
          <span>Download {{ ver }}</span>
        </a>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Alert from '../UI/Alert.vue'

// import Pie from './Version'

export default {
  components: {
    // 'pie-chart': Pie
    Alert
  },
  props: {
    currentver: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      ver: null,
      verCur: this.currentver,
      link: null,
      update: {
        needUpdate: null,
        showMessage: true,
        message: ''
      },
      loading: true,
      error: {
        error: false,
        message: null
      }
    }
  },
  mounted() {
    axios
      .get('https://api.github.com/repos/vedees/wcms/releases/latest', {})
      .then(response => {
        this.ver = response.data.tag_name
      })
      .catch(error => {
        this.error.error = true
        this.error.message = 'API rate limit exceeded  =( Update page later.'
        console.log(error)
      })
      .finally(() => {
        this.loading = false
        if (this.ver > this.verCur) {
          this.update.needUpdate = true
          this.update.message = this.ver + ' is available! Please updates!'
        } else {
          this.update.needUpdate = false
          this.update.message = 'You are using the latest version'
        }
      })
  }
}
</script>
