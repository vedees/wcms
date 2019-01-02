<template>
  <section>
    <div class="container">

      <!-- title wrapper -->
      <div class="title__wrapper">
        <div class="title">
          <h1 class="ui-title-1">Images</h1>
        </div>
        <div class="icons">
          <svg @click="list = true" :class="{ active: list}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg>
          <svg @click="list = false" :class="{ active: !list}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
        </div>
      </div>

      <!-- tags -->
      <div class="title__wrapper" style="margin-bottom:10px;">
        <div class="tags__wrapper">
          <div class="ui-tag__wrapper"><div @click="img = images; type = 'images'" :class="{ active: type === 'images' }" class="ui-tag"><span class="tag-title">All</span></div></div>
        </div>
        <div class="tags__wrapper">
          <div class="ui-tag__wrapper"><div @click="img = imgmain; type = 'imgmain'" :class="{ active: type === 'imgmain' }" class="ui-tag"><span class="tag-title">Main</span></div></div>
          <div class="ui-tag__wrapper"><div @click="img = imgcontent; type = 'imgcontent'" :class="{ active: type === 'imgcontent' }" class="ui-tag"><span class="tag-title">Content</span></div></div>
          <div class="ui-tag__wrapper"><div @click="img = imgicon; type = 'imgicon'" :class="{ active: type === 'imgicon' }" class="ui-tag"><span class="tag-title">Icons</span></div></div>
        </div>
      </div>

      <!-- Search input -->
      <Search placeholder="Img name" :value="search" @search="search = $event"></Search>

      <!-- Alerts - info WCMS -->
      <!-- tag - main -->
      <Alert v-if="type === 'imgmain' && message.tagMain === true" @close="message.tagMain = !message.tagMain">
        <span slot="title" class="alert-title">
          Only &lt;img&gt; with class wcms-img-main. <br> Example: &lt;img class=&quot;wcms-img-main&quot; src=&quot;images/example.jpg&quot;&gt;
        </span>
      </Alert>
      <!-- tag - content -->
      <Alert v-if="type === 'imgcontent' && message.tagContent === true" @close="message.tagContent = !message.tagContent">
        <span slot="title" class="alert-title">
          Only &lt;img&gt; with class wcms-img-content. <br> Example: &lt;img class=&quot;wcms-img-content&quot; src=&quot;images/example.jpg&quot;&gt;
        </span>
      </Alert>
      <!-- tag - content -->
      <Alert v-if="type === 'imgicon' && message.tagIcon === true" @close="message.tagIcon = !message.tagIcon">
        <span slot="title" class="alert-title">
          Only &lt;img&gt; for icons. With class wcms-img-icon. <br> Example: &lt;img class=&quot;wcms-img-icon&quot; src=&quot;images/example.jpg&quot;&gt;
        </span>
      </Alert>

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
          :type="type">
        </Modal>

      </div>
    </div>
  </section>
</template>

<script>
//TODO VUELIDATE
import Search from './UI/Search.vue'
import Alert from './UI/Alert.vue'
import Modal from './ImagesModal.vue'
export default {
  components: {
    Search,
    Alert,
    Modal
  },
  props: {
    images: {
      type: Array,
      required: true
    },
    imgmain: {
      type: Array,
      required: true
    },
    imgcontent: {
      type: Array,
      required: true
    },
    imgicon: {
      type: Array,
      required: true
    }
  },
  data () {
    return {
      search: '',
      list: false,
      showModal: false,
      message: {
        tagMain: true,
        tagContent: true,
        tagIcon: true
      },
      img: this.images,
      type: 'images',
      imageId: null,
      imageTitle: null,
      imagePath: null,
      imageWidth: null,
      imageHeight: null
      //TODO file size
    }
  },
  computed: {
    searchFilter () {
      let array = this.img,
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
