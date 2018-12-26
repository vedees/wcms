<template>
  <div class="code__wrapper">
    <table class="ui-table ui-table--hover">
      <thead>
        <tr>
          <th><span>ID</span></th>
          <th><span>Type</span></th>
          <th><span>File Name</span></th>
          <th><span>Size</span></th>
          <th><span>Last Edit</span></th>
        </tr>
      </thead>
      <tbody>
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
            <td><span class="ui-text-regular"> {{ file.size }} </span></td>
            <td><span class="ui-text-regular"> {{ file.editTime }} </span></td>
        </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
export default {
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
