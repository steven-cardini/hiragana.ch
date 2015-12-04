<?php
if (!Auth::isLoggedIn()) {
  header("location:".ROOT_DIR."login");
  exit;
}
