<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

//! Code Edtor - Only for include
//! Settings - codeeditor.js
?>


<section id="codeeditor">
  <div class="container">
    <h2 class="ui-title-2">Code Editor</h2>
    <div id="container333">
    <!-- Navigation -->
    <?php include('includes/nav/editor.php'); ?>

  <div id="panel">
    <div id="editor" class="card" aria-label="Editor">
      <textarea id="taCode1" class="code" wrap="logical" spellcheck="false" placeholder="Code goes here...">

      </textarea>
    </div>
    <div id="preview" class="card" aria-label="Preview">
      <iframe id="preview-frame"></iframe>
    </div>
  </div>
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <div class="modal-h1">Keyboard Commands</div>
      <div class="modal-h2">Search</div>
      <dl>
        <dt>Ctrl-F / Cmd-F</dt><dd>Start searching</dd>
        <dt>Ctrl-G / Cmd-G</dt><dd>Find next</dd>
        <dt>Shift-Ctrl-G / Shift-Cmd-G</dt><dd>Find previous</dd>
        <dt>Shift-Ctrl-F / Cmd-Option-F</dt><dd>Replace</dd>
        <dt>Shift-Ctrl-R / Shift-Cmd-Option-F</dt><dd>Replace all</dd>
        <dt>Alt-F</dt><dd>Persistent search (dialog doesn't autoclose,
        enter to find next, Shift-Enter to find previous)</dd>
        <dt>Alt-G</dt><dd>Jump to line</dd>       
      </dl>
    </div>
  </div>
</div>


  </div>
</section>

<div id="scripts">

<!-- Other Libraries -->
<script src="https://cdn.jsdelivr.net/npm/split-js@1.0.1/split.min.js"></script>
<!-- <script src="https://rawgit.com/nathancahill/Split.js/master/split.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
<!-- Lint requirements -->
<script src="https://rawgit.com/jshint/jshint/master/dist/jshint.js"></script>
<script src="https://rawgit.com/zaach/jsonlint/master/web/jsonlint.js"></script>
<script src="https://rawgit.com/yaniswang/HTMLHint/master/lib/htmlhint.js"></script>
<script src="https://rawgit.com/CSSLint/csslint/master/dist/csslint.js"></script>
<!-- Codemirror -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/codemirror.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/mode/xml/xml.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/mode/javascript/javascript.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/mode/css/css.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/mode/htmlmixed/htmlmixed.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/hint/show-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/hint/xml-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/hint/html-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/hint/css-hint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/lint/lint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/lint/html-lint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/lint/javascript-lint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/lint/json-lint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/lint/css-lint.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/display/autorefresh.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/display/fullscreen.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/display/placeholder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/edit/matchbrackets.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/edit/matchtags.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/selection/active-line.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/scroll/simplescrollbars.js"></script>
<!-- CodeMirror: Code Folding -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/foldcode.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/foldgutter.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/brace-fold.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/xml-fold.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/indent-fold.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/fold/comment-fold.js"></script>
<!-- CodeMirror: Search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/scroll/annotatescrollbar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/dialog/dialog.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/search/searchcursor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/search/search.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/search/jump-to-line.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/search/matchesonscrollbar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.29.0/addon/search/searchcursor.js"></script>

<script src="http://localhost:8080/wcms/wex/static/js/main.js"></script>

</div>

      <!-- Close #app -->
      </div>
    <!-- Close .content-wrapper-->
    </div>

  <!-- Footer -->
  <footer></footer>

<!-- Close .wrapper -->
</div>

</body>
</html>