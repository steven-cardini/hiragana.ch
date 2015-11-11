<?php
if (!Auth::isAdmin()) {
  header("location:index.php");
  exit;
}
