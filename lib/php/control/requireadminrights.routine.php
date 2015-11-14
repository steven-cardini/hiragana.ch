<?php
if (!Auth::isAdmin()) {
  header("location:".ROOT_DIR."login");
  exit;
}
