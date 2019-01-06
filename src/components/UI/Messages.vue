<template>
  <table class="ui-table">
  <tbody>
    <tr
      v-for="message in messages"
      :key="message.title" >
      <td>
        <a :href="message.link" :class="{ link : message.link}">
          <span v-if="message.label === 'note'" class="ui-label ui-label--purple"> {{ message.label }}</span>
          <span v-if="message.label === 'info'" class="ui-label ui-label--primary">{{ message.label }}</span>
          <span>{{ message.title }}</span>
        </a>
          <span class="time" v-if="message.time">{{ message.time }}</span>
      </td>
    </tr>
  </tbody>
</table>
</template>

<script>
export default {
  props: {
    messages: {
      type: Object,
      required: true
    }
  },
  data () {
    return {}
  },
  computed: {},
  methods: {}
}
</script>

<style scoped>
.link {
  color: #3f48e8;
  font-weight: 500;
}
td {
  display: flex;
  justify-content: space-between;
  padding: 7px 4px;
  min-height: unset;
  font-size: 14px;
}
.ui-label {
  min-width: 20px;
  margin-right: 8px;
  padding: 2px 7px;
  font-size: 12px;
  border-radius: 8px;
  text-align: center;
}
.ui-label svg {
  margin-right: 3px;
  width: 12px;
  height: 12px;
}
.time {
  color: #a5a6a8;
}
.ui-table td {
  min-height: unset;
}
</style>
