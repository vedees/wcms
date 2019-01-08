<template>
  <table class="ui-table">
    <transition-group name="list" tag="tbody">
      <tr
        v-for="message in messages"
        :key="message.title" >
        <td>
          <a :href="message.link" :class="{ link : message.link}">
            <!-- whats label -->
            <span v-if="message.label === 'note'" class="ui-label ui-label--purple"> {{ message.label }}</span>
            <span v-if="message.label === 'info'" class="ui-label ui-label--primary">{{ message.label }}</span>
            <!-- whats lang -->
            <span v-if="message.titleRu && lang === 'ru' ">{{ message.titleRu }}</span>
            <span v-else>{{ message.title }}</span>
          </a>
            <!-- set time -->
            <span class="time" v-if="message.time">{{ message.time }}</span>
          </td>
      </tr>
    </transition-group>

    <!-- Load more -->
    <div class="button-list button-list--center">
      <button @click="$emit('more')" class="button button--round button-default icon-wrapper" :disabled="messagesLength === 0" :class="{ 'button--disable': messagesLength === 0 }">
        <Preloader v-if="loading"></Preloader>
        <span v-else>Load more</span>
      </button>
    </div>
  </table>
</template>

<script>
import Preloader from './Preloader.vue'
export default {
  components: { Preloader },
  props: {
    messages: {
      type: Array,
      required: true
    },
    lang: {
      type: String,
      default: 'en'
    },
    messagesLength: {
      type: Number,
      default: 10
    },
    loading: {
      type: Boolean,
      default: false
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
.button-list {
  margin-top: 20px;
}
.button-list--center{
  display: flex;
  justify-content: center;
}
.button--disable {
  /* todo uimini */
  cursor: default
}
/* Animation */
.list-item {
  display: inline-block;
  margin-right: 10px;
}
.list-enter-active, .list-leave-active {
  transition: all 1s;
}
.list-enter, .list-leave-to /* .list-leave-active до версии 2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
</style>
