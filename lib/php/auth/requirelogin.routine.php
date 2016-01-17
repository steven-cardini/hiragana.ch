<?php
if (!Auth::isLoggedIn()) {
  $_SESSION['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
  header("location:".ROOT_DIR."login");
  exit;
}
