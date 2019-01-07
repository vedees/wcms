<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\text;

class Replace {
  //! FIXED 0.2.6
  public function str_replace_nth($search, $replace, $subject, $nth) {
    $found = preg_match_all('#'.$search.'#', $subject, $matches, PREG_OFFSET_CAPTURE);
    if (false !== $found && $found > $nth) {
      return substr_replace($subject, $replace, $matches[0][$nth][1], strlen($search));
    }
    return $subject;
  }
}