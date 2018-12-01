<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

require 'core/initialize.php'; ?>

<?php $page_title = 'Text Editing - WEX CMS';
      $page = 'text';?>

<?php include('includes/header.php') ?>

<?php $text = new Text();
      $text_all = $text->get_text_all();
      // Get data
    	$subject = file_get_contents($pagename);

  // Find GET request
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $text_edit = $text_all[$id]->title;
    $text_output = $text->str_replace_nth($text_edit, $_POST['textareaForText'], $subject, 0);
    // Output
    file_put_contents($pagename, $text_output);
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=text.php\">";
  }
?>




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
