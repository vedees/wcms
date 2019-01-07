<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

namespace wcms\classes\auth;

class Login {

  public function check_login () {
    if (isset($_POST['login_submit'])) {
      $errors = [];
      $name = $_POST['login'];
      $pass = $_POST['password'];

      // TODO FIX ERROR to glob
      // Validation name
      if (is_blank($name)) {
        $errors[] = 'Name cannot be blank';
      // Validation pass
      } else if (is_blank($pass)) {
        $errors[] = 'Password cannot be blank';
      // If there were no Errors
      } else {
        // Try to login
        // Check user login/password  ||  Find user in $_SESSION
        // if (trim($name) === $admin_name && trim($pass) === $admin_password || $_SESSION['logged_user'] = $admin_name && $admin_password = $_SESSION['logged_password']) {
        if ($name === $GLOBALS['admin_name'] && $pass === $GLOBALS['admin_password']) {
          // Session start
          $_SESSION['logged_user'] = $GLOBALS['admin_name'];
          $_SESSION['logged_password'] = md5($GLOBALS['admin_password']);

          //TODO - если не прошел редирект месседж о переходе
          echo 'hi ';
          redirect_to('index.php');
        // Error pass
        } else {
          $errors[] = 'Username or Password is not correct';
        }
      }
      if (!empty($errors)) {
        echo '<div class="error-login">' . array_shift($errors) . '</div> <br>';
      }
    }
  }

  // Check admin
  private function is_logged_in() {
    // Having a logged_password in the session serves a dual-purpose:
    return isset($_SESSION['logged_password']);
  }

  // Check require login
  public function require_login() {
    if(!$this->is_logged_in()) {
      redirect_to('login.php');
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }
}