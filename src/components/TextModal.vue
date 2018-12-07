<template>
  <Modal @close="$emit('close')">
    <span
      slot="messageBox-title"
      style="color: #333333">
      Filed ID: {{ id }}
    </span>
    <div slot="body">
      <form
        method="POST"
        :action="'text.php?id='+id">
          <textarea
            name="textareaForText"
            v-model="titleEditing"
            ></textarea>
          <div class="button-list">
            <button class="button button-success button--round" name="text_submit" type="submit">Save</button>
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
    }
  },
  data () {
    return {
      search: '',
      showModal: true,
      // dont mutating prop
      titleEditing: this.title
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
  }
}
</script>

//TODO Style