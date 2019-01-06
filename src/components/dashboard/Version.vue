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
        this.error.message = error
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
