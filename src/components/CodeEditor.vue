<template>
<section id="codeEditing">
  <div class="container">
    <h2 class="ui-title-2">Code Editor</h2>
    <div class="code__wrapper">
      <form method="POST" action="cssjs.php">
        <label class="radio"><input type="radio" name="html" checked onclick="setHtml('something')"><span>HTML</span></label>
        <label class="radio"><input type="radio" name="html" ><span>Draft First</span></label>
        <label class="radio"><input type="radio" name="html" ><span>Draft Second</span></label>

        <!-- The code editor -->
        <textarea v-model="code" @change="otputHtml" id="codeEditor">
        </textarea>

        <!-- The preview window -->
        <h5>Preview</h5>
        <div v-html="code">
        </div>

        <button class="button button--round button-primary" type="submit" name="codeEditor">Save</button>
      </form>
    </div>
  </div>
</section>

</template>
<script>
// TODO codemirror-vue
import Modal from './TextModal.vue'
export default {
  components: {
    Modal
  },
  props: {
    code: {
      type: String,
      required: false
    }
  },
  data () {
    return {
      editor: null
      // getOutput: '',
    }
  },
  mounted () {
    this.editor = CodeMirror.fromTextArea(document.getElementById('codeEditor'), {
      lineNumbers: true,
    })
    // this.getOutput =  this.editor.getValue()
  }
}
</script>

//TODO Style