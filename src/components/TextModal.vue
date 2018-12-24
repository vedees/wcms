<template>
  <Modal @close="$emit('close')">
    <span
      slot="messageBox-title"
      style="color: #333333">
      Filed ID: {{ id }} - {{ type }}
    </span>
    <div slot="body">
      <form method="GET" action="text.php">
        <input name="id" v-model="id" type="hidden">
        <input name="type" v-model="type" type="hidden">
        <textarea name="text" v-model="titleEditing"></textarea>
        <div class="button-list"><button class="button button-success button--round" type="submit">Save</button></div>
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
    type: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      search: '',
      showModal: true,
      // Fix bug with id. Get Props
      type: this.type,
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