<template>
  <section>
    <div class="container">
      <div class="title__wrapper">
        <div class="title">
          <h1 class="ui-title-1">Images</h1>
        </div>
        <div class="icons">
          <svg @click="list = true" :class="{ active: list}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
          <svg @click="list = false" :class="{ active: !list}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </div>
      </div>

      <!-- Search input -->
      <Search placeholder="Img name" :value="search" @search="search = $event"></Search>

      <!-- img list -->
      <div class="image__list">
        <div class="ui-card ui-card--shadow"
          v-for="image in searchFilter"
          :key="image.id"
          :class="{ list: list}"
        >
          <div class="img__wrapper">
            <img
              @click="editModal(image.id, image.title, image.path, image.sizeW, image.sizeH)"
              :src="image.path"
            >
          </div>
          <div class="messageBox__content">
            <div class="messageBox__info">
              <p class="ui-title-4">ID: {{ image.id }}</p>
              <p class="ui-text-small">Name: {{ image.title }}</p>
              <p class="ui-text-small">Size: {{ image.fileSize }}</p>
              <p class="ui-text-small">Width: {{ image.sizeW }}px; Height: {{ image.sizeH }}px;</p>
              <p class="ui-text-small">Last Edit: {{ image.editTime }}</p>
            </div>
            <div class="button-list" style="padding: 20px;">
              <button class="button button--round button-primary"
                @click="editModal(image.id, image.title, image.path, image.sizeW, image.sizeH)">Edit</button>
            </div>
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
      </div>
    </div>
  </section>
</template>

<script>
//TODO VUELIDATE
import Search from './UI/Search.vue'
import Modal from './ImagesModal.vue'
export default {
  components: {
    Modal,
    Search
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
      list: false,
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
    searchFilter () {
      let array = this.images,
          search    = this.search
      // Not dirty
      if (!search) return array
      // Small
      search = search.trim().toLowerCase();
      // Filter
      array = array.filter(function(item){
        if (item.title.toLowerCase().indexOf(search) !== -1) {
          return item;
        }
      })
      // Error
      return array;
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

<style scoped>
svg:first-child{
  margin-right: 12px;
}
svg {
  color: #adaeb0;
}
svg.active {
  color: #333333;
}
.ui-card {
  position: relative;
  width: 49.4%;
  max-height: 600px;
  padding: 0;
  margin-bottom: 20px;
}
/* .ui-card .list  */
</style>
