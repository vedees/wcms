<?php
/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */
require 'core/initialize.php';
?>

<?php $user = new wcms\classes\auth\Login;
      $user->check_login();?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login - WEX CMS</title>

  <!-- Common style -->
  <style>
    .form__wrapper {
      display: flex;
        display: -webkit-box;
        display: -ms-flexbox;
      align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
      justify-content: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
      width: 100%;
      height: 90vh;
    }
    .error-login {
      position: absolute;
      left: 0;
      right: 0;
      top: 24%;
      text-align: center;
      color: #fc5c65;
    }
    @media only screen and (min-width : 700px) {
      input {
        min-width: 410px;
      }
    }
  </style>

  <!-- dev server not working in this page -->
  <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
  <section id="login">
    <div class="container">
      <div class="form__wrapper">
        <!-- Form -->
        <form action="login.php" method="POST">
          <!-- TODO version -->
          <h1 class="ui-title-1"> WCMS </h1>
          <label>Login</label>
          <div class="input--icon">
            <div class="input--svg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></div>
            <input type="text" name="login" class="input--text" require/>
          </div>
          <label>Password</label>
          <div class="input--icon">
            <div class="input--svg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg></div>
            <input type="password" name="password" class="input--text" require/>
          </div>
          <div class="button-list">
            <button class="button button-primary button--round" name="login_submit" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>

