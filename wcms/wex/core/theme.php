<?php
  // Default
  if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'red';
  // GET
  } else if (isset($_GET['theme']) && $_SESSION['theme'] != $_GET['theme'] && !empty($_GET['theme'])) {
      //* Red
      if ($_GET['theme'] == 'red') {
        $_SESSION['theme'] = 'red';
      //* White
      } else if ($_GET['theme'] == 'white') {
        $_SESSION['theme'] = 'white';
      }
  }
