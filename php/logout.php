<?php
      session_start();

      session_destroy();
      header("Location: ../Login-Register-Password/Login.php");
      exit;
?>