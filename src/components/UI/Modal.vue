<template>
<transition name="modal">
  <div class="ui-messageBox__wrapper">
      <div class="ui-messageBox">

        <div class="ui-messageBox__header">
          <slot name="messageBox-title">
            Message Box
          </slot>
          <span class="button-close" @click="$emit('close')" ></span>
        </div>

        <div class="ui-messageBox__content">
          <slot name="body">
            default body
          </slot>
        </div>

        <div class="ui-messageBox__footer">
          <slot name="footer">
              <button class="button button-primary" @click="$emit('close')">
                  Save
              </button>
          </slot>
        </div>
    </div>
  </div>
</transition>
</template>

<script>
export default {
  props: {},
  data () {
    return {}
  },
  computed: {},
  methods: {}
}
</script>
