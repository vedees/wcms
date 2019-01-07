<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

$page = new wcms\classes\Pagename();
$page->set_page();?>

<form id="htmlLinkMenu" method="POST">
  <div class="sidebar-list">
    <select name="pagename">
      <?php
        foreach ($GLOBALS['html_list'] as $html_page) {
          echo "<option value=\"{$html_page}\"";
          if ($GLOBALS['pagename'] == $html_page) {
            echo " selected";
          }
          echo ">{$html_page}</option>";
        }
      ?>
    </select>
    <button class="button button--round button-primary" type="submit"> <?php echo $lang['editingPageSelect'] ?> </button>
  </div>
</form>