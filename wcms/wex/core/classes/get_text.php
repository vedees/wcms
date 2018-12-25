<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Text {
  // NEW way
  // Find all Text
  public function get_text_all () {
    // Text list
    $headlines = $this->get_headlines();
    /*
    * Каждая функция принимает айди.
    * Чтобы небыло бага с поиском тайтла по айди
    * нужно пересчитывать длинну каждого массива
    * и отправлять новый счет как параметр в каждую функцию.
    */
    $headlines_length = count($headlines);
    $text = $this->get_p_and_span($headlines_length);
    $text_length = count($text) + $headlines_length;
    $button = $this->get_button($text_length);
    $all = array_merge($headlines, $text, $button);
    // $text_all = $this->finder($text, 0, 'All');
    return $all;
  }
  // OLD way
  public function get_text_all_old () {
    // Text list
    $text = $this->get_text();
    $text_all = $this->finder($text, 0, 'All');
    return $text_all;
  }

  public function get_seo ($id=0) {
    // Text list
    $text = array();
    // Text single
    // TODO rm foreach
    foreach($GLOBALS['html']->find('title') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('description') as $element)
      $text[] = $element->outertext;

    $text_all = $this->finder($text, $id, 'Headline');
    return $text_all;
  }

  public function get_headlines ($id=0) {
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

    $text_all = $this->finder($text, $id, 'Headline');
    return $text_all;
  }

  public function get_button ($id=0) {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('button') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, $id, 'Button');
    return $text_all;
  }

  public function get_p_and_span ($id=0) {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('p') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('span') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, $id, 'Text');
    return $text_all;
  }

  public function get_content_main ($id=0) {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('p.wcms-text') as $element)
      $text[] = $element->outertext;
    foreach($GLOBALS['html']->find('span.wcms-text') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, $id, 'Content-main');
    return $text_all;
  }

  public function get_content ($id=0) {
    // Text list
    $text = array();
    foreach($GLOBALS['html']->find('div.wcms-textarea') as $element)
      $text[] = $element->outertext;
    $text_all = $this->finder($text, $id, 'Content', false);
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