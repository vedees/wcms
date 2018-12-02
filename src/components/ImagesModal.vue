<template>
  <Modal @close="$emit('close')">
    <span
      slot="messageBox-title"
      style="color: #333333">
      Filed ID: {{ id }}
    </span>
    <div slot="body">
      <img :src="path">
      <form
        method="POST"
        enctype="multipart/form-data"
        :action="'images.php?img='+path">

      <span style="color: #333;">Image: {{ title }}</span>
      <!-- Image info -->
      <p class="ui-text-smaller"
        style="color: #333;"
        v-if="!imgProcessCompleted"
        > Width: {{ width }} , Height: {{ height }}</p>
      <p style="color: #333;"
        v-if="imgProcessCompleted"
        v-html="textTitle"
        >ERROR!!!</p>
      <label class="button button-primary"  for="imageFile"> {{ textImageTest }} </label>
      <input
        id='imageFile'
        name="inputForImages"
        type="file"
        required
        style="display: none;"
        @change="processFile($event)"
        >

      <button class="button button-primary" name="text_submit" type="submit">Save</button>

      </form>
    </div>
    <div slot="footer">
      <!-- emty -->
    </div>
  </Modal>
</template>

<script>
import Modal from './UI/Modal.vue'
export default {
  components: {
    Modal
  },
  props: {
    id: {
      type: Number,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    path: {
      type: String,
      required: true
    },
    width: {
      type: Number,
      required: true
    },
    height: {
      type: Number,
      required: true
    }
  },
  data () {
    return {
      showModal: true,
      imgProcessCompleted: false,

      textTitle: '',
      textImageTest: 'Select your file here',
    }
  },
  methods: {
    processFile(event) {
      // Add set time Out
      console.log(event.target.files[0])
      let name = event.target.files[0].name
      let type = event.target.files[0].type
      let size = (event.target.files[0].size / 1e+6).toFixed(2)
      // Check
      let sizeCheck = ''
      if (size > 1) {
        sizeCheck = ' Big size'
      } else {
        sizeCheck = ' Good size'
      }

      this.textImageTest = name
      //TODO es6 + center items
      this.textTitle =
        '<span>' + 'Change ' + '</span>'
        + '<span style="color: #26de81;">' + '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> ' + name + '</span>'
        + '<p>' + 'Type: ' + type + '</p>'
        + '<p>' + 'Size: ' + size + ' Mb' + sizeCheck + '</p>'
      // Completed
      this.imgProcessCompleted = true
    }
  }
}
</script>

//TODO Style