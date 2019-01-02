<template>
  <Table :thead="['ID', 'Type', 'File Name', 'Size', 'Last Edit']">
    <tbody slot="tbody">
      <tr v-for="file in files"
          :key="file.id">
        <td><span class="ui-text-regular"> {{ file.id }} </span></td>
        <td><span class="ui-text-regular"> {{ file.type }} </span></td>
        <!-- Click TD -->
        <a :href="'cssjs.php?path='+file.path + '&type=' + type">
          <td class="center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
            <span class="ui-text-regular"> {{ file.title }} </span>
          </td>
        </a>
        <!-- TODO kb to mb -->
        <td><span class="ui-text-small"> {{ file.size }} </span></td>
        <td><span class="ui-text-small"> {{ file.editTime }} </span></td>
      </tr>
    </tbody>
  </Table>
</template>

<script>
import Table from './UI/Table.vue'
export default {
  components: {
    Table
  },
  props: {
    files: {
      type: Array,
      required: true
    },
    type: {
      type: String,
      default: 'htmlmixed'
    }
  }
}
</script>
