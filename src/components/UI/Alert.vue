<template>
   <transition name="slide-fade">
      <div class="ui-alert ui-alert--primary">
        <slot name="title">
          <!-- <span class="alert-title"> </span> -->
        </slot>
        <span @click="$emit('close')" class="button-close"></span>
      </div>
    </transition>
</template>

<script>
export default {
  data () {
    return {}
  },
  computed: {},
  methods: {}
}
</script>

<style scoped>
.ui-alert {
  padding: 14px 30px;
  margin: 30px 0;
}
</style>
