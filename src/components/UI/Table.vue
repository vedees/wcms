<template>
  <table class="ui-table ui-table--hover">

    <!-- Head -->
    <thead>
      <tr>
        <!-- Thead titles -->
        <th v-for="th in thead"
            :key="th">
          <span>{{ th }}</span>
        </th>
      </tr>
    </thead>

    <!-- Body -->
      <slot name="tbody">
        <!-- Slot for body -->
        <!-- <tbody></tbody> -->
      </slot>
  </table>
</template>

<script>
export default {
  props: {
    thead: {
      type: Array,
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
.center {
  display: flex;
  align-items: center;
  cursor: pointer;
}
.center svg {
  width: 18px;
  margin-right: 8px;
}
</style>
