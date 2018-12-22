<template>
  <section id="textEdit">
    <div class="container">
      <!-- Search input -->
      <Search placeholder="Text fragment" :value="search" @search="search = $event"></Search>
      <!-- Table  -->
      <table class="ui-table ui-table--hover">
        <thead>
          <tr>
            <th><span>ID</span></th>
            <th><span>Field</span></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="text in textFilter"
            :key="text.id">
            <td><span class="ui-text-regular"> {{ text.id }} </span></td>
            <td class="center" @click="editModal(text.id, text.title)" >
              <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
              <span class="ui-text-regular"> {{ text.title }} </span>
            </td>
          </tr>
        </tbody>
      </table>
      <Modal
        v-if="showModal"
        @close="showModal = false"
        :id="textId"
        :title="textTitle"
        >
      </Modal>
    </div>
  </section>
</template>

<script>
import Modal from './TextModal.vue'
export default {
  components: {
    Modal
  },
  props: {
    text: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      search: '',
      showModal: false,
      textId: null,
      textTitle: null
    }
  },
  computed: {
    textFilter () {
      let textArray = this.text,
          search    = this.search
      // Not dirty
      if (!search) return textArray
      // Small
      search = search.trim().toLowerCase();
      // Filter
      textArray = textArray.filter(function(item){
        if (item.title.toLowerCase().indexOf(search) !== -1) {
          return item;
        }
      })
      // Filter Array
      return textArray;
    }
  },
  methods: {
    editModal (id, title) {
      this.textId = id
      this.textTitle = title
      this.showModal = !this.showModal
    }
  }
}
</script>
