<template>
  <div class="image_wrapper">
    <div class="ui-card ui-card--shadow">
      <img src="">
      <p class="ui-title-4">ID: </p>
      <p class="ui-text-small">Size: </p>
      <p class="ui-text-small">Path: </p>
      <!-- <button class="button button--round button-primary" @click='imageModal(<?php echo json_encode($test_array2) ?>)'>Edit</button> -->
    </div>
  </div>
</template>

<script>
import Modal from './TextModal.vue'
export default {
  components: {
    Modal
  },
  props: {
    images: {
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