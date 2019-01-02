<template>
  <div class="charts__wrapper">
    <div class="chart-pie">
      <pie-chart
        :height='300'
        :html='html'
        :img='img'
        :css='css'
        :js='js'>
      </pie-chart>
    </div>
  </div>
</template>

<script>
import Pie from './CounterPie'

export default {
  components: {
    'pie-chart': Pie
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
