<section id="codeEditing">
  <div class="container">
    <form method="POST" action="cssjs.php">
      <label class="radio"><input type="radio" name="html" checked value="1" onclick="setHtml('something')"><span>Html (1)</span></label>
      <label class="radio"><input type="radio" name="html" value="1" onclick="setHtml('heading')"><span>Html (2)</span></label>
      <label class="radio"><input type="radio" name="html" value="1" onclick="setHtml('list')"><span>Html (3)</span></label>

      <!-- The code editor -->
      <textarea id="codeEditor"></textarea>

      <!-- The preview window -->
      <h5>Preview</h5>
      <div id="output" class="box"></div>

      <button class="button button--round button-primary" type="submit" name="codeEditor">Save</button>
  </div>
</section>



<?php include('includes/footer.php'); ?>


<script>

// The preview window
const $output = document.getElementById("output");

// The current html_values item being edited
let current;

// A list of html which will be used in the editor
let html_values = {
    something:  '<div class="something">\n' +
                '    <span>Hello</span>\n' +
                '</div>',

    heading:    '<h2>Some Heading</h2>\n' +
                '<p>Some content</p>',

    list:       '<ul class="a-list">\n' +
                '    <li>Number 1</li>\n' +
                '    <li>Number 2</li>\n' +
                '    <li>Number 3</li>\n' +
                '</ul>'
};

// Updates the preview window and html_values
function updateHtml () {
    const val            = codemirror.getValue();
    $output.innerHTML    = val;
    html_values[current] = val;
}

// Set the html_values item in the editor and preview
function setHtml(x) {
    current = x;
    codemirror.setValue(html_values[x]);
}

// The codeMirror editor object
let codemirror = CodeMirror.fromTextArea( document.getElementById("codeEditor"), {
    lineNumbers     : true,
    lineWrapping    : true,
    mode            : "xml",
    htmlMode        : true,
    theme           : "twilight",
    tabSize         : 4,
    indentUnit      : 4
});

// On every keystroke the preview and html_values will be updated
codemirror.on("change", updateHtml);

// Start the page using html_values.something
setHtml("something");

</script>