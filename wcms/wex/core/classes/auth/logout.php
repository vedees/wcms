<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

class Logout {
  // Logout
  function logout_user(){
    unset($_SESSION['logged_user']);
    unset($_SESSION['logged_password']);
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
  }

}
