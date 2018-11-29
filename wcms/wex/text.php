<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/wexcms/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'WEX CMS - Text Editing';
      $page = 'text';
      $text_all = get_text_all(); ?>

<?php include('includes/header.php') ?>

<section>
  <div class="container">
    <h1 class="ui-title-1"> Text Editing </h1>
  </div>
</section>

<section id="textEdit">
  <div class="container">
    <text-component
      :text='<?php echo json_encode($text_all); ?>' >
    </text-component>
  </div>
</section>

<?php include('includes/footer.php') ?>
