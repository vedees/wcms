<template>
  <div class="table__wrapper">
    <div class="table-search__wrapper">
      <div class="search">
        <!-- Icon -->
        <div class="search--icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></div>
      </div>
      <input
        type="text"
        class="search--input"
        placeholder="Search text fragment"
        v-model="search"/>
    </div>
    <table class="ui-table ui-table--hover">
      <thead>
        <tr>
          <th><span>ID</span></th>
          <th><span>Field</span></th>
        </tr>
      </thead>
      <tbody>
        // TODO FIX INDEX
        <tr v-for="(item, index) in textFilter"
          :key="index">
          <td><span class="ui-text-regular"> {{ item.id }} </span></td>
          <td class="td--center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon></svg>
            <span class="ui-text-regular" @click="editModal(item.id, item.title)"> {{ item.title }} </span>
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

//TODO Style