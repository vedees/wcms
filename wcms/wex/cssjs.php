<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'CSS/JS Editing - WEX CMS';
      $page = 'cssjs';?>

<?php include('includes/header.php') ?>
<?php $get_file = new CssJs();
      $css = $get_file->all_css();
      $js = $get_file->all_js();

// Find GET request
$html_from_template = '';
if (isset($_GET['path'])) {
  $path = $_GET['path'];
  $html_from_template = htmlspecialchars(file_get_contents($path));
?>
<!-- Code Editor -->
<code-editor-component
    :code='<?php echo json_encode($html_from_template); ?>'>
</code-editor-component>

<?php } else { ?>

<section id="cssjsEditInfo">
  <div class="container">
    <h1 class="ui-title-1">CSS and JS editing</h1>
    <p>Here you can edit yours css/js files</p>
  </div>
</section>

<section id="cssEdit">
  <div class="container">
    <h2 class="ui-title-2">CSS files</h2>
    <code-list-component
      :files='<?php echo json_encode($css) ?>'>
    </code-list-component>
  </div>
</section>

<section id="jsEdit">
  <div class="container">
    <h2 class="ui-title-2">JS files</h2>
    <code-list-component
      :files='<?php echo json_encode($js) ?>'>
    </code-list-component>
  </div>
</section>

<?php } ?>
<?php include('includes/footer.php'); ?>
