<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
$user = new Login;
$user->require_login();?>

<?php $page_title = $lang['textTitle'];
      $page = 'text';?>

<?php include('includes/header.php') ?>

<?php $text = new Text();
      $all = $text->get_text_all();
      $seo = $text->get_seo();
      $headline = $text->get_headlines();
      $get_p_and_span = $text->get_p_and_span();
      $button = $text->get_button();
      $content_main = $text->get_content_main();
      $content = $text->get_content();
      // Get data
    	$subject = file_get_contents($pagename);
  // Find GET request
  if (isset($_GET['id'])) {
    //TODO Refing + swich
    if ($_GET['type'] === 'all') { $text_edit = $all[$_GET['id']]->title; }
    else if ($_GET['type'] === 'seo') { $text_edit = $seo[$_GET['id']]->title; }
    else if ($_GET['type'] === 'headline') { $text_edit = $headline[$_GET['id']]->title; }
    else if ($_GET['type'] === 'textonly') { $text_edit = $get_p_and_span[$_GET['id']]->title; }
    else if ($_GET['type'] === 'button') { $text_edit = $button[$_GET['id']]->title; }
    else if ($_GET['type'] === 'contentmain') { $text_edit = $content_main[$_GET['id']]->title; }
    else if ($_GET['type'] === 'content') { $text_edit = $content[$_GET['id']]->title; }
    else { $text_edit = $all[$_GET['id']]->title; }
    //TODO use parser
    $text_output = $text->str_replace_nth($text_edit, $_GET['text'], $subject, 0);
    // Output
    file_put_contents($pagename, $text_output);
    redirect_to('text.php');
  }
?>

<section style="padding-bottom:0px;">
  <div class="container">
    <h1 class="ui-title-1"> <?php echo $lang['textH1'] ?> </h1>
    <p class="ui-text-small"> <?php echo $lang['textHelper'] ?> </p>
  </div>
</section>

<text-component
  :all='<?php echo htmlentities(json_encode($all, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :seo='<?php echo htmlentities(json_encode($seo, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :headline='<?php echo htmlentities(json_encode($headline, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :textonly='<?php echo htmlentities(json_encode($get_p_and_span, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :button='<?php echo htmlentities(json_encode($button, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :contentmain='<?php echo htmlentities(json_encode($content_main, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :content='<?php echo htmlentities(json_encode($content, JSON_HEX_QUOT), ENT_QUOTES);?>'>
</text-component>

<?php include('includes/footer.php') ?>
