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

<?php $page_title = $lang['textTitle'];
      $page = 'text';?>

<?php include('includes/header.php') ?>

<?php // Text Class
      $text = new wcms\classes\text\Text();
      // Text Replace Class
      $text_replace = new wcms\classes\text\Replace();
      // all
      $all = $text->get_text_all();
      // seo
      $seo = $text->get_seo();
      // headline
      $headline = $text->get_headlines();
      // p_and_span
      $p_and_span = $text->get_p_and_span();
      // buttons
      $button = $text->get_button();
      // links
      $link = $text->get_link();
      // text main
      $content_main = $text->get_content_main();
      // text content
      $content = $text->get_content();

      // Get data
    	$subject = file_get_contents($pagename);

  // Find GET request
  if (isset($_GET['id'])) {
    switch ($_GET['type']) {
      case 'all':
        $text_edit = $all[$_GET['id']]->title;
        break;
      case 'seo':
        $text_edit = $seo[$_GET['id']]->title;
        break;
      case 'headline':
        $text_edit = $headline[$_GET['id']]->title;
        break;
      case 'textonly':
        $text_edit = $textonly[$_GET['id']]->title;
        break;
      case 'button':
        $text_edit = $button[$_GET['id']]->title;
        break;
      case 'link':
        $text_edit = $link[$_GET['id']]->title;
        break;
      case 'contentmain':
        $text_edit = $contentmain[$_GET['id']]->title;
        break;
      case 'content':
        $text_edit = $content[$_GET['id']]->title;
        break;
      default:
        $text_edit = $all[$_GET['id']]->title;
        break;
    }
    // Output
    $text_output = $text_replace->str_replace_nth($text_edit, $_GET['text'], $subject, 0);
    // Replace
    file_put_contents($pagename, $text_output);
    redirect_to('text.php');
  }
?>

<section style="padding-bottom:0px;">
  <div class="container">
    <h1 class="ui-title-1"> <?php echo $lang['textH1'] ?> </h1>
    <!-- done -->
    <!-- <p class="ui-text-small"> <?php echo $lang['textHelper'] ?> </p> -->
  </div>
</section>

<text-component
  :all='<?php echo htmlentities(json_encode($all, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :seo='<?php echo htmlentities(json_encode($seo, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :headline='<?php echo htmlentities(json_encode($headline, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :textonly='<?php echo htmlentities(json_encode($p_and_span, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :button='<?php echo htmlentities(json_encode($button, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :link='<?php echo htmlentities(json_encode($link, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :contentmain='<?php echo htmlentities(json_encode($content_main, JSON_HEX_QUOT), ENT_QUOTES);?>'
  :content='<?php echo htmlentities(json_encode($content, JSON_HEX_QUOT), ENT_QUOTES);?>'>
</text-component>

<?php include('includes/footer.php') ?>
