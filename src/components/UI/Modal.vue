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

<style scoped>
.ui-messageBox__wrapper {
  display: flex!important;
  position: relative;
}
.ui-messageBox__wrapper img{
  display: block;
  max-height: 200px;
}

.ui-messageBox__wrapper{
  position: fixed;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.ui-messageBox {
  padding: 20px 30px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .ui-messageBox,
.modal-leave-active .ui-messageBox {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>
