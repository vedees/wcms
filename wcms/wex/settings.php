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

<?php $page_title = 'WEX CMS - Dashboard';
      $page = 'settings';?>

<?php include('includes/header.php') ?>

<section>
  <div class="container">
    <h1 class="ui-title-1"> <?php echo $lang['settings'] ?> </h1>
    <p class="ui-text-small"> <?php echo $lang['settingsDescr'] ?> </p>
  </div>
</section>

<section>
  <div class="container container--small">
    <form class="settings__form" action='settings.php' method="GET">

      <!-- Uset settings -->
      <h2 class="ui-title-2">User settings:</h2>

      <!-- Language -->
      <div class="setting__wrapper">
        <span class="ui-text-regular"> <?php echo $lang['settingsLanguage'] ?>:</span>
        <select name="lang">
          <?php
            foreach ($lang_choices as $lang_choice) {
              echo "<option value=\"{$lang_choice}\"";
              if ($_SESSION['lang'] == $lang_choice) {
                echo " selected";
              }
              echo ">{$lang_choice}</option>";
            }
          ?>
        </select>
      </div>

      <!-- Theme -->
      <div class="setting__wrapper">
        <span class="ui-text-regular"> <?php echo $lang['settingsTheme'] ?>:</span>
        <select name="theme">
          <?php
            foreach ($theme_choices as $theme_choice) {
              echo "<option value=\"{$theme_choice}\"";
              if ($_SESSION['theme'] == $theme_choice) {
                echo " selected";
              }
              echo ">{$theme_choice}</option>";
            }
          ?>
        </select>
      </div>

      <!-- dev settings -->
      <h2 class="ui-title-2">Developers:</h2>

      <!-- Code Theme -->
      <div class="setting__wrapper">
        <span class="ui-text-regular"> <?php echo $lang['settingsThemeCode'] ?>:</span>
        <select name="editor_theme">
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
      </div>

      <!-- Show Tags -->
      <div class="setting__wrapper" style="margin-bottom: 10px;">
        <span class="ui-text-regular">Show Tags:</span>
        <select name="tags_show">
          <?php
            foreach ($tags_show_choices as $tags_show_choice) {
              echo "<option value=\"{$tags_show_choice}\"";
              if ($_SESSION['tags_show'] == $tags_show_choice) {
                echo " selected";
              }
              echo ">{$tags_show_choice}</option>";
            }
          ?>
        </select>
      </div>
      <div class="center" style="margin-bottom: 20px;">
        <p class="ui-text-small">If yes: &lt;h1 class="my-title"&gt;Titleastronomy&lt;h1&gt;</p>
        <p class="ui-text-small">If no: Title astronomy</p>
      </div>


      <div class="button-list">
        <button class="button button-primary button--round" type="submit"> <?php echo $lang['save'] ?></button>
      </div>
    </form>
    </div>
  </div>
</section>


<?php include('includes/footer.php') ?>
