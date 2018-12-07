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

// Finish editing
if (isset($_GET['finish'])) {
  $path = $_GET['finish'];
  file_put_contents($path, $_POST['textAreaCode']);
}


// GET CSS & JS file
$html_from_template = '';
if (isset($_GET['path'])) {
  $path = $_GET['path'];
  $html_from_template = htmlspecialchars(file_get_contents($path));
?>
<section>
  <div class="container">
    <div class="common-header__center">
      <h2 class="ui-title-2" style="margin-bottom:0;">Code Editor</h2>
      <form method="GET" style="width:30%;" class="common-form__center">
        <select name="editor_theme" style="margin-bottom:0; margin-right: 16px">
          <?php
            foreach ($editor_theme_choices as $editor_theme_choice) {
              echo "<option value=\"{$editor_theme_choice}\"";
              if ($_SESSION['editor_theme'] == $editor_theme_choice) {
                echo " selected";
              }
              echo ">{$editor_theme_choice}</option>";
            }
          ?>
        </select>
        <button class="button button-default button--round" type="submit">Save</button>
      </form>
    </div>
  </div>
</section>
<!-- Code Editor -->
<code-editor-component
    action='cssjs.php'
    :code='<?php echo json_encode($html_from_template); ?>'
    :path='<?php echo json_encode($path); ?>'
    theme='<?php echo $_SESSION['editor_theme']?> '>
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
