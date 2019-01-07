<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\text;

class Find {
  static function find_text($where_find, $id, $type, $reg=true ) {
    $result = array();
    for ($i=0; $i < count($where_find); $i++) {
      if (mb_strlen(trim($where_find[$i]), 'utf-8') > 1) {
        $object = new \stdClass();
        $object->id = $id;
        //TODO lang
        $object->type = $type;
        // форич проставляет теги. регулярка удаляет все в <> + трим пробелов. по дефолту усовие срабатывает
        // if ($reg) { $object->title = preg_replace('/(<([^>]+)>)/U', '', trim($where_find[$i])); }
        // else { $object->title = trim($where_find[$i]); }
        $object->title = trim($where_find[$i]);
        $id++;
        $result[] = $object;
      }
    }
    return $result;
  }

}