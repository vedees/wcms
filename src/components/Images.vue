<template>
  <div class="image_list">
    <div class="ui-card ui-card--shadow"
      v-for="image in images"
      :key="image.id"
    >
      <div class="img__wrapper">
        <img
          @click="editModal(image.id, image.title, image.path, image.sizeW, image.sizeH)"
          :src="image.path"
        >
      </div>
      <div class="content">
        <p class="ui-title-4">ID: {{ image.id }}</p>
        <p class="ui-text-small">Name: {{ image.title }}</p>
        <p class="ui-text-small">Size: {{ image.fileSize }}</p>
        <p class="ui-text-small">Width: {{ image.sizeW }}px; Height: {{ image.sizeH }}px;</p>
        <p class="ui-text-small">Last Edut: {{ image.editTime }}</p>
      </div>
      <div class="button-list" style="padding: 20px;">
        <button class="button button--round button-primary"
          @click="editModal(image.id, image.title, image.path, image.sizeW, image.sizeH)">Edit</button>
      </div>
  </div>

  <Modal
    v-if="showModal"
    @close="showModal = false"
    :id="imageId"
    :title="imageTitle"
    :path="imagePath"
    :width="imageWidth"
    :height="imageHeight"
    >
  </Modal>

  </div>
</template>

<script>
//TODO VUELIDATE
import Modal from './ImagesModal.vue'
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
      imageId: null,
      imageTitle: null,
      imagePath: null,
      imageWidth: null,
      imageHeight: null
      //TODO size
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
    editModal (id, title, path, width, height) {
      this.imageId = id
      this.imageTitle = title
      this.imagePath = path
      this.imageWidth = width
      this.imageHeight = height
      // console.log({id, title, width, height})
      this.showModal = !this.showModal
    }
  }
}
</script>