<?php
if (!Auth::isLoggedIn()) {
  header("location:index.php");
  exit;
}
