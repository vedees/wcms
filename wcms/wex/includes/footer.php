      <!-- Close #app -->
      </div>
    <!-- Close .content-wrapper-->
    </div>

  <!-- Footer -->
  <footer></footer>

<!-- Close .wrapper -->
</div>

<!-- webpack js run with ?dev prefix ( http://localhost:8888/index.php?dev ) -->
<?php if (isset($_GET['dev'])) echo '<script src="' . $dev_port . '/wcms/wex/assets/js/main.js"></script>';
      else echo '<script src="assets/js/main.js"></script>';?>


</body>
</html>