<?php
if (!Auth::isAdmin()) {
  header("location:".ROOT_DIR."home");
  exit;
}
