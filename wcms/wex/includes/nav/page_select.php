<?php

?>

<form id="htmlLinkMenu" method="POST">
  <div class="sidebar-list">
    <select name="pagename">
      <?php
        foreach ($GLOBALS['html_list'] as $html_page) {
          echo "<option value=\"{$html_page}\"";
          if ($GLOBALS['pagename'] == $html_page) {
            echo " selected";
          }
          // TODO change echo to {}
          echo ">{$html_page}</option>";
        }
      ?>
    </select>
    <button class="button button--round button-primary" type="submit"> <?php echo $lang['editingPageSelect'] ?> </button>
  </div>
</form>