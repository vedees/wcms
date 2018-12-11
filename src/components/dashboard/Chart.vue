<template>
  <div class="charts__wrapper">
    <div class="chart-pie">
      <line-chart
        :height='300'
        :html='html'
        :img='img'
        :css='css'
        :js='js'>
      </line-chart>
    </div>
  </div>
</template>

<script>
import LineChart from './LineChart'

export default {
  components: {
    'line-chart': LineChart
  },
  props: {
    html: {
      type: String,
      required: true
    },
    img: {
      type: String,
      required: true
    },
    css: {
      type: String,
      required: true
    },
    js: {
      type: String,
      required: true
    }
  },
}
</script>
