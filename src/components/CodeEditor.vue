<template>
  <section id="codeEditing">
    <div class="container">
      <div class="code__wrapper" >
        <form method="POST"
          :action="action + '?finish=' + path">
          <!-- The code editor -->
          <textarea v-model="get_decode" name="textAreaCode" id="codeEditor">
          </textarea>

          <div class="button-list">
            <button class="button button--round button-primary" type="submit" name="codeEditor">Save</button>
          </div>
          <div class="button-list button-list--fixed">
            <button class="button button--round button-success" type="submit" name="codeEditor">Save</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
// TODO codemirror-vue
import htmlD from 'locutus/php/strings/html_entity_decode'
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
    },
    theme: {
      type: String,
      required: false
    },
    type: {
      type: String,
      default: 'htmlmixed'
    }
  },
  data () {
    return {
      editor: null,
      get_decode: htmlD(this.code)
      // getOutput: '',
    }
  },
  mounted () {
    this.editor = CodeMirror.fromTextArea(document.getElementById('codeEditor'), {
      lineNumbers     : true,
      lineWrapping    : true,
      mode            : this.type,
      htmlMode        : true,
      theme           : this.theme,
      tabSize         : 4,
      indentUnit      : 4
    })
    // this.getOutput =  this.editor.getValue()
  }
}
</script>
