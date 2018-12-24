<template>
  <Modal @close="$emit('close')">
    <span
      slot="messageBox-title"
      style="color: #333333">
      Image ID: {{ id }}
    </span>
    <div slot="body">
      <!-- Images -->
      <div class="img__wrapper"><img :src="path"></div>
      <!-- Form -->
      <form
        method="POST"
        enctype="multipart/form-data"
        :action="'images.php?img='+path">

        <!-- Content -->
        <div class="messageBox__content">
          <!-- Info -->
          <div class="messageBox__info">
            <h4 class="ui-title-4">{{ title }}</h4>
            <!-- Image info before -->
            <p class="ui-text-smaller"
              style="color: #333;"
              v-if="!imgProcessCompleted"
            > Width: {{ width }} , Height: {{ height }}</p>
            <!-- Image info after -->
            <p style="color: #333;"
              v-if="imgProcessCompleted"
              v-html="textTitle">
            Somthig Wrong!</p>
          </div>

          <!-- Buttons -->
          <div class="button-list button-list--center" style="padding 10px">
            <div class="load" v-show="!imgProcessCompleted">
              <label class="button button-primary"  for="imageFile"> {{ textImageTest }} </label>
              <input
                id='imageFile'
                name="inputForImages"
                type="file"
                required
                style="display: none;"
                @change="processFile($event)"
                >
            </div>
            <div class="save" v-show="imgProcessCompleted">
              <button class="button button-success button--round" name="text_submit" type="submit">Save</button>
            </div>
          </div>
        </div>
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
    },
    type: {
      type: String,
      required: true
    }
  },
  data () {
    return {
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
        '<span style="color: #26de81;">' + 'Completed '
        + '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg> ' + name + '</span>'
        + '<p>' + 'Type: ' + type + '</p>'
        + '<p>' + 'Size: ' + size + ' Mb - <span style="color: #26de81;">' + sizeCheck + '</span> </p>'
      // Completed
      this.imgProcessCompleted = true
    }
  }
}
</script>

//TODO Style