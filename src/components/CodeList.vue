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
          <td class="td--center">
            <span class="ui-text-regular" > {{ file.title }} </span>
          </td>
          <!-- TODO kb to mb -->
          <td><span class="ui-text-regular"> {{ file.size }} </span></td>
          <td><span class="ui-text-regular"> {{ file.editTime }} </span></td>

        </tr>
      </tbody>
    </table>

  </div>
</template>

<script>
// ???
import Modal from './TextModal.vue'
export default {
  components: {
    Modal
  },
  props: {
    files: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      search: '',
      fileId: null,
      fileTitle: null
    }
  },
  computed: {
  },
  methods: {
    editModal (id, title) {
      this.fileId = id
      this.fileTitle = title
      this.showModal = !this.showModal
    }
  }
}
</script>

//TODO Style