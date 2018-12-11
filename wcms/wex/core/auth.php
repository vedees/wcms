<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

//TODO FIX to array
$errors = '';
// Check POST request
if(isset($_POST['login_submit'])){
  //TODO Find user in $_SESSION to class
  // Check user login/password  ||  Find user in $_SESSION
  if (trim($_POST['login']) === $admin_name && trim($_POST['password']) === $admin_password || $_SESSION['logged_user'] = $admin_name && $admin_password = $_SESSION['logged_password']) {
    // Login
    $_SESSION['logged_user'] = $admin_name;
    // Password (md5)
    $_SESSION['logged_password'] = md5($admin_password);
    $admin_password = $_SESSION['logged_password'];
    redirect_to('/wex/index.php');
  } else {
    $errors = 'Password not correct';
  }
}