<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\text;

use wcms\classes\text\Parser;
use wcms\classes\text\Find;

class Text {
  // Consctruct
  public function __construct() {
    // Text Parser
    $this->text = new Parser();
    // Text Finder
    $this->find = new Find();
  }

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
    // $text_all = $this->find->find_text($text, 0, 'All');
    return $all;
  }

  public function get_seo ($id=0) {
    $text = array();
    $text = $this->text->get_html_parse($text, 'title');
    $text = $this->text->get_html_parse($text, 'description');
    $text_all = $this->find->find_text($text, $id, 'SEO');
    return $text_all;
  }

  public function get_headlines ($id=0) {
    $text = array();
    // TODO to callback
    $text = $this->text->get_html_parse($text, 'h1');
    $text = $this->text->get_html_parse($text, 'h2');
    $text = $this->text->get_html_parse($text, 'h3');
    $text = $this->text->get_html_parse($text, 'h4');
    $text = $this->text->get_html_parse($text, 'h5');
    $text = $this->text->get_html_parse($text, 'h6');

    // print_r($text);
    $text_all = $this->find->find_text($text, $id, 'Headline');
    return $text_all;
  }

  public function get_button ($id=0) {
    $text = array();
    $text = $this->text->get_html_parse($text, 'button');
    $text_all = $this->find->find_text($text, $id, 'Button');
    return $text_all;
  }

  public function get_link ($id=0) {
    $text = array();
    $text = $this->text->get_html_parse($text, 'a');
    $text_all = $this->find->find_text($text, $id, 'Link');
    return $text_all;
  }


  public function get_p_and_span ($id=0) {
    $text = array();
    $text = $this->text->get_html_parse($text, 'p');
    $text = $this->text->get_html_parse($text, 'span');
    $text_all = $this->find->find_text($text, $id, 'Text');
    return $text_all;
  }

  public function get_content_main ($id=0) {
    $text = array();
    $text = $this->text->get_html_parse($text, 'p.wcms-text');
    $text = $this->text->get_html_parse($text, 'span.wcms-text');
    $text_all = $this->find->find_text($text, $id, 'Content-main');
    return $text_all;
  }

  public function get_content ($id=0) {
    $text = array();
    foreach($GLOBALS['html']->find('div.wcms-textarea') as $element)
      $text[] = $element->outertext;
    $text_all = $this->find->find_text($text, $id, 'Content', false);
    return $text_all;
  }

}