import {Doughnut} from 'vue-chartjs'

export default {
  extends: Doughnut,
  props: ['html', 'css', 'js', 'img'],
  mounted () {
    this.renderChart({
      labels: ['HTML', 'CSS', 'JS', 'IMG'],
      datasets: [{
        //TODO UI color
        backgroundColor: [ '#ec6630','#0096e6','#f1af4b','#14a085' ],
        borderWidth: 4,
        //TODO FIX black theme
        borderColor: '#ffffff',
        data: [this.html, this.css, this.js,this.img]
      }]
    },
    {
      // Cricle Radius
      cutoutPercentage: 94,
      // Auto width/height
      responsive: true,
      maintainAspectRatio: false,
      // Labels conf
      legend: {
        display: true,
        position: 'bottom',
        // Text
        labels: {
          usePointStyle: true,
          padding: 20,
          //TODO Add ff
          fontColor: '#909399'
        }
      }
    })
  }
}