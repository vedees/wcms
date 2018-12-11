<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

$errors = [];
// Check POST request
if (isset($_POST['login_submit'])){

  $name = $_POST['login'];
  $pass = $_POST['password'];

  // Validations
  if (is_blank($name)) {
    $errors[] = 'Username cannot be blank';
  }
  if (is_blank($pass)) {
    $errors[] = 'Password cannot be blank';
  }
  // if there were no errors, try to login
  if (empty($errors)) {
    //TODO Find user in $_SESSION to class
    // Check user login/password  ||  Find user in $_SESSION
    // if (trim($name) === $admin_name && trim($pass) === $admin_password || $_SESSION['logged_user'] = $admin_name && $admin_password = $_SESSION['logged_password']) {
    if (trim($name) === $admin_name && trim($pass) === $admin_password) {
      // Login
      $_SESSION['logged_user'] = $admin_name;
      // Password (md5)
      $_SESSION['logged_password'] = md5($admin_password);
      // redirect_to('/wex/index.php');
    } else {
      $errors[] = 'Username or Password is not correct';
    }
  }

}

// Check admin
function is_logged_in() {
  // Having a logged_password in the session serves a dual-purpose:
  return isset($_SESSION['logged_password']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_login() {
  if(!is_logged_in()) {
    //TODO FIX
    // redirect_to('/wex/index.php');
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
  } else {
    // Do nothing, let the rest of the page proceed
  }
}
