<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
$user = new wcms\classes\auth\Login;
$user->require_login();?>

<?php $page_title = $lang['cssjsTitle'];
      $page = 'cssjs';?>

<?php include('includes/header.php') ?>

<?php $get_file = new wcms\classes\css_js\Files();
      $css = $get_file->all_css();
      $js = $get_file->all_js();

// Finish editing
if (isset($_GET['finish'])) {
  $path = $_GET['finish'];
  // Преобразование кода обратно
  // Преобразуются и двойные, и одиночные кавычки.
  file_put_contents($path, html_entity_decode($_POST['textAreaCode'], ENT_QUOTES));
}

// GET CSS & JS file
if (isset($_GET['path'])) {
  $path = $_GET['path'];
  $html_from_template = htmlspecialchars(file_get_contents($path));
?>
<section>
  <div class="container">
    <div class="common-header__center">
      <h2 class="ui-title-2" style="margin-bottom:0;"> <?php echo $lang['codeEditor'] ?> </h2>
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
<div class="container">
  <?php // echo $lang['cssjsHelper']; - done ?>
</div>
<code-editor-component
    action='cssjs.php'
    :code='<?php echo htmlentities(json_encode($html_from_template, JSON_HEX_QUOT), ENT_QUOTES);?>'
    :path='<?php echo json_encode($path);?>'
    theme='<?php echo $_SESSION['editor_theme'];?>'
    type='<?php echo $_GET['type'];?>'>
</code-editor-component>

<?php } else { ?>

<!-- <section id="cssjsEditInfo">
  <div class="container">
    <h1 class="ui-title-1"> <?php echo $lang['cssjsH1'] ?> </h1>
  </div>
</section> -->

<!-- css -->
<section id="cssEdit">
  <div class="container">
    <h2 class="ui-title-2"> <?php echo $lang['css'] ?> </h2>
    <files-table-component
      :files='<?php echo json_encode($css) ?>'
      type='css'>
    </files-table-component>
  </div>
</section>
<!-- js -->
<section id="jsEdit">
  <div class="container">
    <h2 class="ui-title-2"> <?php echo $lang['js'] ?> </h2>
    <files-table-component
      :files='<?php echo json_encode($js) ?>'
      type='javascript'>
    </files-table-component>
  </div>
</section>

<?php } ?>
<?php include('includes/footer.php'); ?>
