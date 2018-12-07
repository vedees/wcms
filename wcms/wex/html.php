<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'HTML Editing - WEX CMS';
      $page = 'html';?>

<?php include('includes/header.php');
      $html_from_template = htmlspecialchars(file_get_contents($pagename));

// Find GET Finish editing
if (isset($_GET['finish'])) {
  $path = $_GET['finish'];
  file_put_contents($path, $_POST['textAreaCode']);
  // TODO func
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=html.php\">";
}
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

<code-editor-component
    action='html.php'
    code='<?php echo print_r($html_from_template); ?>'
    path='<?php echo $pagename; ?>'
    theme='<?php echo $_SESSION['editor_theme']?> '>
</code-editor-component>

<?php include('includes/footer.php'); ?>
