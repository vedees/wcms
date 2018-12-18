<?php

?>

<form id="htmlLinkMenu" method="POST">
  <div class="sidebar-list">
    <select name="pagename">
      <?php
        foreach ($GLOBALS['html_list'] as $page) {
          echo "<option value=\"{$page}\"";
          if ($GLOBALS['pagename'] == $page) {
            echo " selected";
          }
          // TODO change echo to {}
          echo ">{$page}</option>";
        }
      ?>
    </select>
    <button class="button button--round button-primary" type="submit"> Editing </button>
  </div>
</form>