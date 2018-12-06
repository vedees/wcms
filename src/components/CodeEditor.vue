<template>
  <section id="codeEditing">
    <div class="container">
      <h2 class="ui-title-2">Code Editor</h2>
      <div class="code__wrapper">
        <form method="POST"
          :action="action + '?finish=' + path">
          <!-- The code editor -->
          <textarea v-model="code" name="textAreaCode" id="codeEditor">
          </textarea>

          <button class="button button--round button-primary" type="submit" name="codeEditor">Save</button>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
// TODO codemirror-vue
export default {
  props: {
    code: {
      type: String,
      required: false
    },
    path: {
      type: String,
      required: true
    },
    action: {
      type: String,
      required: true
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
      lineNumbers     : true,
      lineWrapping    : true,
      mode            : "htmlmixed",
      htmlMode        : true,
      theme           : "twilight",
      tabSize         : 4,
      indentUnit      : 4
    })
    // this.getOutput =  this.editor.getValue()
  }
}
</script>

//TODO Style