<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/wexcms/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

//* Basic functions
function redirect_to ($url) {
	header('Location: ' . $url);
	exit;
}
//TODO global get class
//* Get html file to editing
function get_html_name () {
  if (isset($_POST['pagename'])) {
    $_SESSION['pagename'] = $_POST['pagename'];
  };
  if (isset($_SESSION['pagename'])) {
    $pagename = $_SESSION['pagename'];
  } else {
    // POST Error
    $pagename = 'index.html';
  };
  // Template set page name
  return $template = file_get_contents($pagename);
}

function get_html_select () {
  $html_list = glob("../*.html");
  $html_selected='';
  for ($i = 0; $i < count($html_list); $i++) {
    if($html_list[$i] == $_SESSION['pagename']) {
      $html_selected.=('<option selected>'.$html_list[$i].'</option>');
    } else {
      $html_selected.=('<option>' . $html_list[$i] . '</option>');
    };
  };
  return $html_selected;
}

//! nav active
function nav_is_active ($page, $name) {
  if ($page == $name) return true;
}

//! text
function get_text () {
  $content = preg_replace('/<[^>]+>/', '^', get_html_name() );
  return $text = explode('^', $content);
}

function get_text_all () {
  // Text list
  $id = 0;
  $text_all = array();
  // Text single
  $text = get_text();
  for ($i=0; $i< count($text); $i++) {
    if (strlen(trim($text[$i])) > 1) {
      $object = new stdClass();
      $object->title = (trim($text[$i]));;
      $object->id = $id;
      $id++;
      $text_all[] = $object;
    }
  };
  return $text_all;
}

function str_replace_nth($search, $replace, $subject, $nth) {
  $found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
  if (false !== $found && $found > $nth) {
    return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
  }
  return $subject;
};