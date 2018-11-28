<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $page_title; ?></title>

  <!-- Server fix -->
  <link rel="stylesheet" href="http://localhost:8080/wcms/wex/static/css/main.css">
  <!-- WARRING '/' -->
  <!-- <link rel="stylesheet" href="/wcms/wex/static/css/main.css"> -->
</head>
<body>

  <!-- MAIN WRAPPER -->
  <div class="wrapper">
    <!-- HEADER NAV -->
    <header>
      <div class="navbar navbar-fixed">
        <div class="container">
          <div class="navbar-content"><a class="header-logo" href="index.php">WEX CMS</a>
            <div class="button-burger"><span class="line line-1"></span><span class="line line-2"></span><span class="line line-3"></span></div>
            <div class="navbar-list__wrapper">
              <ul class="navbar-list">
                <li class="navbar-item"><a class="navbar-link" href="/index.html" target="_blank">To site</a></li>
                <li class="navbar-item"><a class="navbar-link" href="settings.php">Settings</a></li>
                <li class="navbar-item"><a class="navbar-link" href="logout.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
  <!-- SIDEBAR -->
  <?php require 'sidebar.php'; ?>
  <!-- CONTENT -->
  <div class="content-wrapper content-wrapper--sidebar content-wrapper--fix-header">
    <div id="app">
