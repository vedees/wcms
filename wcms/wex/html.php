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

<?php $page_title = $lang['settings'];
      $page = 'html';?>

<?php include('includes/header.php');
      //TODO -> get_page.php
      $html_from_template = htmlspecialchars(file_get_contents($GLOBALS['pagename']));

  // Find GET Finish editing
  if (isset($_GET['finish'])) {
    $path = $_GET['finish'];
    file_put_contents($path, $_POST['textAreaCode']);
    redirect_to('html.php');
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
    :code='<?php echo htmlentities(json_encode($html_from_template, JSON_HEX_QUOT), ENT_QUOTES);?>'
    path='<?php echo $GLOBALS['pagename']; ?>'
    theme='<?php echo $_SESSION['editor_theme']?> '>
</code-editor-component>

<?php include('includes/footer.php'); ?>
