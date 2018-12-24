<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Text {
  // Find all Text
  public function get_text_all () {
    // Text list
    $text = $this->get_text();
    $text_all = $this->finder($text, 0, 'All');
    return $text_all;
  }
  public function get_seo () {
    // Text list
    $text = array();
    // Text single
    // TODO rm foreach
    foreach($GLOBALS['html']->find('title') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('description') as $element)
      $text[] = $element->outertext;

    $text_all = $this->finder($text, 0, 'Headline');
    return $text_all;
  }

  public function get_headlines () {
    // Text list
    $text = array();
    // Text single
    // TODO class
    // TODO fix type to h1/h2/..
    // TODO get callback
    foreach($GLOBALS['html']->find('h1') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('h2') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('h3') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('h4') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('h5') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('h6') as $element)
      $text[] = $element->outertext;

    $text_all = $this->finder($text, 0, 'Headline');
    return $text_all;
  }

  public function get_button () {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('button') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, 0, 'Headline');
    return $text_all;
  }

  public function get_p_and_span () {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('p') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('span') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, 0, 'Text Only');
    return $text_all;
  }

  public function get_content_main () {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('span.wcms-text') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('p.wcms-text') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, 0, 'Content-main');
    return $text_all;
  }

  public function get_content () {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('div.wcms-textarea') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, 0, 'Content', false);
    return $text_all;
  }

  //TODO class
  private function finder($where_find, $id, $type, $reg=true ) {
    $result = array();
    for ($i=0; $i< count($where_find); $i++) {
      // TODO rm if
      if (strlen(trim($where_find[$i])) > 1) {
        $object = new stdClass();
        $object->id = $id;
        //TODO lang if
        $object->type = $type;
        // форич проставляет теги. регулярка удаляет все в <> + трим пробелов. по дефолту усовие срабатывает
        if ($reg) { $object->title = preg_replace('/(<([^>]+)>)/U', '', trim($where_find[$i])); }
        else { $object->title = trim($where_find[$i]); }
        $id++;
        $result[] = $object;
      }
    }
    return $result;
  }

  private function get_text () {
    $content = preg_replace('/<[^>]+>/', '^', $GLOBALS['template']);
    return $text = explode('^', $content);
  }

  public function str_replace_nth($search, $replace, $subject, $nth) {
    $found = preg_match_all('/'.preg_quote($search).'/', $subject, $matches, PREG_OFFSET_CAPTURE);
    if (false !== $found && $found > $nth) {
      return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
    }
    return $subject;
  }
}