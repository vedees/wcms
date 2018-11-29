<template>
  <table class="ui-table ui-table--hover">
    <thead>
      <tr>
        <th><span>ID</span></th>
        <th><span>Field</span></th>
        <th><span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in text"
        :key="item"
      >
        <td><span class="ui-text-regular">  {{ index }} </span></td>
        <td><span class="ui-text-regular" @click="editPopup(index, item)"> {{ item }} </span></td>
        <td><span class="ui-text-regular" @click="editPopup(index, item)"> Edit </span></td>
      </tr>

    </tbody>
  </table>
</template>

<script>
export default {
  props: {
    text: {
      type: Array,
      required: true
    }
  },
  methods: {
    editPopup (index, item) {
      console.log(index, item)
    }
  }
}
</script>
