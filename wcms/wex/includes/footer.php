      <!-- Close #app -->
      </div>
    <!-- Close .content-wrapper-->
    </div>

  <!-- Footer -->
  <footer>
  <div class="container center" style="padding: 40px 0;">
    <a class="ui-text-small" href="http://wcms.space">WCMS</a>
    <span class="ui-text-small"> - 2019 &copy; </span>
    <a class="ui-text-small" href="https://github.com/vedees">Vedegis Evgenii</a>
  </div>
  </footer>

<!-- Close .wrapper -->
</div>

<!-- webpack js run with use_dev var-->
<?php if ($use_dev) echo '<script src="' . $dev_port . '/wcms/wex/assets/js/main.js"></script>';
      else echo '<script src="assets/js/main.js"></script>';?>

</body>
</html>